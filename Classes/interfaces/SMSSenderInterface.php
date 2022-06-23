<?php

namespace RemoteConfig\Classes\interfaces;

interface SMSSenderInterface
{
    /**
     * @param string $code
     * @param string $to
     * @return bool
     */
    public function sendCode(string $code, string $to): bool;


    /**
     * @return SMSSenderInterface|null
     */
    public static function getInstance(): ?SMSSenderInterface;
}