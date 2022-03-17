<?php

namespace App\Abstraction\Server;

interface RequestInterface
{

    /**
     * @return array
     * for get all get params
     */
    public function gets(): array;


    /**
     * @return array
     * for get all post params
     */
    public function posts(): array;

    /**
     * @return array
     * for get all headers
     */
    public function headers(): array;

    /**
     * @return array
     * for get all cookies
     */
    public function cookies(): array;

    /**
     * @return array
     * for get all get sessions
     */
    public function sessions(): array;

    /**
     * @param string|null $name
     * @return string|null|array
     * get specific element of post params
     */
    public function post(?string $name = null): string|null|array;

    /**
     * @param string|null $name
     * @return string|null|array
     * get specific element of header
     */
    public function header(?string $name = null): string|null|array;

    /**
     * @param string|null $name
     * @return string|null|array
     * get specific element of post params
     */
    public function get(?string $name = null): string|null|array;

    /**
     * @param string|null $name
     * @return string|null|array
     * get specific element of cookie
     */
    public function cookie(?string $name = null): string|null|array;

    /**
     * @param string|null $name
     * @return string|null|array
     * get specific element of session
     */
    public function session(?string $name = null): string|null|array;


}