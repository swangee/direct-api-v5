<?php
namespace vedebel\directv5\Common;

/**
 * Class ExceptionNotification
 * @package vedebel\directv5\Common
 */
class ExceptionNotification implements \JsonSerializable
{
    const EXCEPTIONS = [
        'NOT_FOUND' => 8800,
        'UPDATE_LED_TO_CREATE' => 10141
    ];
    
    /**
     * The unique identifier of API request.
     * @var
     */
    private $code;

    /**
     * Simple error message
     * @var
     */
    private $message;

    /**
     * @var
     */
    private $details;

    public function __construct(\stdClass $apiError)
    {
        $this->code = $apiError->Code ?? null;
        $this->message = $apiError->Message ?? null;
        $this->details = $apiError->Details ?? null;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'details' => $this->details
        ];
    }
}