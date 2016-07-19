<?php
namespace vedebel\directv5;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Monolog\Formatter\NormalizerFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use vedebel\directv5\Common\ApiException;
use vedebel\directv5\Common\ApiPoints;
use vedebel\directv5\Common\Exceptions\PointsShortageException;
use vedebel\directv5\Common\Repository;
use vedebel\directv5\Common\RequestApiException;

/**
 * Class Client
 * @package vedebel\directv5
 *
 * @method mixed v4PingAPI()
 * @method mixed v4GetClientInfo()
 * @method mixed v4GetClientsList()
 * @method mixed v4AdImage(array $param)
 * @method mixed v4GetBanners(array $param)
 * @method mixed v4CreateNewSubclient(array $param)
 */
class Client
{
    /**
     *
     */
    const OAUTH_URL = 'https://oauth.yandex.ru/token';

    /**
     * Default language for API response messages.
     */
    const DEFAULT_LANGUAGE = 'ru';

    /**
     * List of languages that API supports.
     */
    const SUPPORTED_LANGUAGES = ['en', 'ru', 'tr', 'uk'];

    /**
     *
     */
    const ENDPOINT_TO_COLLECTION_MAP = [
        'campaigns'    => 'Campaigns',
        'adgroups'     => 'AdGroups',
        'keywords'     => 'Keywords',
        'ads'          => 'Ads',
        'bids'         => 'Bids',
        'bidmodifiers' => 'BidModifiers',
        'sitelinks'    => 'Sitelinks',
        'vcards'       => 'VCards'
    ];

    const API_ERROR_CODES = [
        'AUTHORIZATION_ERROR' => 53,
        'INSUFFICIENT_PERMISSIONS' => 54,
        'POINTS_SHORTAGE' => 152,
        'CONCURRENT_REQUESTS_LIMIT' => 506
    ];

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Language for API response messages.
     * @var string
     */
    private $language;

    /**
     * Direct account login to work with.
     * @var string
     */
    private $login;

    /**
     * Direct account token that was generated for application.
     * @var string
     */
    private $token;

    /**
     * @var
     */
    private $config;

    /**
     * @var
     */
    private $logger;

    /**
     * @var
     */
    private $configPath;

    /**
     * @var
     */
    private $sandbox = false;

    /**
     * The amount of API points available for usage.
     * @var ApiPoints
     */
    private $apiPoints;

    /**
     * The ID of the last request. Should be used when contacting to Direct support.
     * @var int
     */
    private $requestId;

    /**
     * @var bool
     */
    private $loggedIn = false;

    /**
     * @var Repository[]
     */
    private $repositories = [];

    /**
     * Client constructor.
     * @param HttpClient $client
     * @param string $applicationId
     * @param string $applicationPassword
     * @param string $configPath
     */
    public function __construct(HttpClient $client, string $applicationId = null, string $applicationPassword = null, string $configPath = null)
    {
        $this->configPath = $configPath ?: realpath(__DIR__ . '/../config.json');
        $this->loadConfig();

        if ($applicationId) {
            $this->config->applicationId = $applicationId;
        }

        if ($applicationPassword) {
            $this->config->applicationPassword = $applicationPassword;
        }

        $this->httpClient = $client;
    }

    /**
     * @param string $login
     * @param string $token
     */
    public function login(string $login = null, string $token = null)
    {
        if ($login) {
            $this->login = $login;
        }

        if ($token) {
            $this->token = $token;
        }

        $this->loggedIn = true;
    }

    /**
     * @param string $code
     * @return mixed
     */
    public function getAccessToken(string $code)
    {
        if (empty($this->config->applicationId)) {
            throw new \UnexpectedValueException('ApplicationId cannot be empty. Set it while Client creation or in config');
        }

        if (empty($this->config->applicationPassword)) {
            throw new \UnexpectedValueException('ApplicationPassword cannot be empty. Set it while Client creation or in config');
        }

        $response = $this->httpClient->post(self::OAUTH_URL, [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'client_id' => $this->config->applicationId,
                'client_secret' => $this->config->applicationPassword
            ]
        ]);

        $response = json_decode($response->getBody());

        if (empty($response->access_token)) {
            throw new \UnexpectedValueException('No token returned. ' . json_encode($response));
        }

        return $response->access_token;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param $language
     */
    public function setLanguage($language)
    {
        if (!in_array($language, self::SUPPORTED_LANGUAGES)) {
            throw new \InvalidArgumentException(sprintf('Language %s is not supported by API.', $language));
        }
        $this->language = $language;
    }

    /**
     * @param bool $useSandbox
     */
    public function setSandbox(bool $useSandbox)
    {
        $this->sandbox = $useSandbox;
    }

    /**
     *
     */
    public function getPoints()
    {
        return $this->apiPoints;
    }

    /**
     * Factory method. Used to create instance of any repository.
     *
     * @param $name
     * @return Repository
     */
    public function getRepository($name)
    {
        if (!empty($this->repositories[$name])) {
            return $this->repositories[$name];
        }

        $camelizedName = '';

        foreach (explode('-', $name) as $namePart) {
            $camelizedName .= ucfirst($namePart);
        }

        $fullClassName = __NAMESPACE__ . '\\' . $camelizedName . '\\' . $camelizedName . 'Repository';

        if (!class_exists($fullClassName)) {
            throw new \InvalidArgumentException('Provided repository doesn`t exist');
        }

        $repository = new $fullClassName($this);

        $this->repositories[$name] = $repository;

        return $repository;
    }

    /**
     * @param string $service
     * @param string $method
     * @param array $data
     * @param callable $processResponse
     * @return mixed
     * @throws ApiException
     * @throws PointsShortageException
     * @throws RequestApiException
     */
    public function request(string $service, string $method = 'get', $data = [], callable $processResponse = null)
    {
        if (!$this->loggedIn) {
            $this->loginFromConfig();
        }

        $requestUrl = $this->getServiceUrl($service);
        $headers = $this->getRequestHeaders();

        $data = [
            'method' => $method,
            'params' => $data
        ];

        if ($this->logger) {
            $message = 'Sending request.' . PHP_EOL;
            $message .= 'Headers:' . PHP_EOL;

            foreach ($headers as $headerName => $headerValue) {
                $message .= $headerName . ': ' . $headerValue . PHP_EOL;
            }

            $this->log($message, $data);
        }

        $response = $this->httpClient->request('GET', $requestUrl, [
            'json' => $data,
            'headers' => $headers
        ]);

        $this->processResponse($response);

        $decodedResponse = json_decode($response->getBody());

        if ($this->logger) {
            $message = 'Reading response.' . PHP_EOL;
            $message .= 'Headers:' . PHP_EOL;

            foreach ($response->getHeaders() as $headerName => $headerValues) {
                $message .= $headerName . ': ' . implode(", ", $headerValues) . PHP_EOL;
            }

            $this->log($message, $decodedResponse);
        }

        if ($method === 'get') {
            $serviceProperty = self::ENDPOINT_TO_COLLECTION_MAP[$service];
        } else {
            $serviceProperty = sprintf('%sResults', ucfirst($method));
        }

        if (isset($decodedResponse->error)) {
            if (!empty($decodedResponse->error->error_code)) {
                switch ((int) $decodedResponse->error->error_code) {
                    case self::API_ERROR_CODES['POINTS_SHORTAGE']:
                        throw new PointsShortageException($decodedResponse->error);
                        break;
                }
            }
            throw new RequestApiException($decodedResponse->error);
        } elseif (is_callable($processResponse)) {
            return $processResponse($decodedResponse);
        } elseif (isset($decodedResponse->result)) {
            $result = [
                'collection' => []
            ];

            if (isset($decodedResponse->result->$serviceProperty)) {
                $result['collection'] = $decodedResponse->result->$serviceProperty;

                if ($method === 'get') {
                    $result['hasNextPage'] = isset($decodedResponse->result->LimitedBy);
                }
            }

            return $result;
        }

        throw new ApiException('Unexpected response from API');
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (strpos($name, 'v4') !== 0) {
            throw new \BadMethodCallException(sprintf('Tying to call unknown method %s', $name));
        }

        if (!$this->loggedIn) {
            $this->loginFromConfig();
        }

        $apiMethodName = str_replace('v4', '', $name);

        $requestParams = [
            'method' => $apiMethodName,
            'token' => $this->token,
            'locale' => $this->language ?? self::DEFAULT_LANGUAGE
        ];

        if (!empty($arguments[0])) {
            $requestParams['param'] = $arguments[0];
        }

        return $this->requestFallback($requestParams);
    }

    /**
     * @param array $requestParams
     * @return mixed
     * @throws ApiException
     */
    private function requestFallback(array $requestParams)
    {
        $response = $this->httpClient->request('POST', $this->config->fallbackEndpoint, [
            'json' => $requestParams
        ]);

        $response = $response->getBody();
        $decodedResponse = json_decode($response);

        if (!empty($decodedResponse->data)) {
            return $decodedResponse->data;
        } elseif (!empty($decodedResponse->error_code)) {
            throw new ApiException($decodedResponse->error_detail, $decodedResponse->error_code);
        } else {
            throw new ApiException('Invalid API response. Response: ' . $response);
        }
    }

    /**
     *
     */
    private function loadConfig()
    {
        $configFile = $this->configPath;

        $pathInfo = pathinfo($configFile);

        if (file_exists($configFile)) {
            switch ($pathInfo['extension']) {
                case 'json':
                    $config = json_decode(file_get_contents($configFile));
                    break;

                case 'php':
                    $config = require $configFile;

                    if (is_array($config)) {
                        $config = (object) $config;
                    }
                    break;

                default:
                    throw new \InvalidArgumentException('Invalid config passed');
            }

            if (empty($config->logFile)) {
                $config->logFile = null;
            } else {
                $this->logger = fopen($config->logFile, 'a+');
            }

            $this->config = $config;
        }
    }

    /**
     *
     */
    private function loginFromConfig()
    {
        if (!$this->loggedIn) {
            $this->login($this->config->login, $this->config->token);
        }
    }

    /**
     * @param string $service
     * @return string
     */
    private function getServiceUrl(string $service)
    {
        $url = $this->sandbox ? $this->config->sandboxEndpoint : $this->config->endpoint;
        return $url . $service;
    }

    /**
     * @return array
     */
    private function getRequestHeaders()
    {
        $headers = [];

        if ($this->login) {
            $headers['Client-Login'] = $this->login;
        }

        if ($this->token) {
            $headers['Authorization'] = sprintf('Bearer %s', $this->token);
        }

        $headers['Accept-Language'] = $this->language ?: self::DEFAULT_LANGUAGE;

        return $headers;
    }

    /**
     * @param Response $response
     */
    private function processResponse(Response $response)
    {
        if ($points = $response->getHeaderLine('Units')) {
            $this->apiPoints = new ApiPoints($points);
        }

        if ($requestId = $response->getHeaderLine('RequestId')) {
            $this->requestId = $requestId;
        }
    }

    private function log($message, $data)
    {
        if ($this->logger) {
            while (!flock($this->logger, LOCK_EX)) {
                sleep(usleep(1000));
            }

            fwrite($this->logger, sprintf('[%s]: %s' . PHP_EOL, date('Y-m-d H:i:s'), $message));
            fwrite($this->logger, json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL . PHP_EOL);

            flock($this->logger, LOCK_UN);
        }
    }
}