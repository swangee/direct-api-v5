<?php
namespace vedebel\directv5\Common;


class RequestApiException extends ApiException
{
    /**
     * The unique identifier of API request.
     * @var
     */
    private $requestId;

    /**
     * Simple error message
     * @var
     */
    private $errorString;

    public function __construct(\stdClass $apiError)
    {
        parent::__construct($apiError->error_detail, $apiError->error_code);

        $this->requestId = $apiError->request_id;
        $this->errorString = $apiError->error_string;
    }

    /**
     * @return mixed
     */
    public function getErrorString()
    {
        return $this->errorString;
    }

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->requestId;
    }
}