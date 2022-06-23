<?php

namespace RemoteConfig\Classes\SMS;

use RemoteConfig\Classes\interfaces\SMSSenderInterface;

class SMSManager
{

    /**
     * @var SMSManager|null
     */
    public static ?SMSManager $manager = null;

    /**
     * @return SMSSenderInterface
     */
    public function getSender(): SMSSenderInterface
    {
        return Melipayamak::getInstance();
    }

    /**
     * @return SMSManager
     */
    public static function getInstance(): SMSManager
    {
        if (is_null(self::$manager)) {
            self::$manager = new static();
        }
        return self::$manager;
    }
}