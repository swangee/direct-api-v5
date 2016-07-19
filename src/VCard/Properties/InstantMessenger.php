<?php
namespace vedebel\directv5\VCard\Properties;

use vedebel\directv5\Common\Object;

/**
 * Class InstantMessenger
 * @package vedebel\directv5\VCard\Properties
 * 
 * @property string $messengerClient
 * @property string $messengerLogin
 */
class InstantMessenger extends Object
{
    /**
     * InstantMessenger constructor.
     *
     * @param string $messengerClient
     * @param string $messengerLogin
     */
    public function __construct(string $messengerClient, string $messengerLogin)
    {
        $attributes = [
            'messengerClient' => $messengerClient,
            'messengerLogin' => $messengerLogin
        ];
        
        parent::__construct($attributes);
    }
}