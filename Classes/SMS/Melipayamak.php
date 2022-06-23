<?php

namespace RemoteConfig\Classes\SMS;

use RemoteConfig\Classes\interfaces\SMSSenderInterface;

class Melipayamak implements \RemoteConfig\Classes\interfaces\SMSSenderInterface
{

    /**
     *
     */
    private static ?Melipayamak $melipayamak = null;

    /**
     * @param string $code
     * @param string $to
     * @return bool
     */
    public function sendCode(string $code, string $to): bool
    {
        $url = 'https://console.melipayamak.com/api/send/shared/52f9a404de7b41ae87bf898249ee0673';
        $data = array('bodyId' => 86351, 'to' => $to, 'args' => [$code]);
        $data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array('Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);
        if (!isset($result->status)){
            return false;
        }
        if ($result->status == "ارسال موفق بود"){
            return true;
        }else{
            return false;
        }

    }

    /**
     * @return SMSSenderInterface|null
     */
    public static function getInstance(): ?SMSSenderInterface
    {
        if (is_null(self::$melipayamak)) {
            self::$melipayamak = new static();
        }
        return self::$melipayamak;
    }
}