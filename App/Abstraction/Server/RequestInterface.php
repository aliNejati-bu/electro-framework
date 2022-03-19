<?php

namespace Electro\App\Abstraction\Server;

use stdClass;

interface RequestInterface
{

    /**
     * @return array all the get parameters
     * for get all get params
     */
    public function gets(): array;


    /**
     * @return array all the post parameters
     * for get all post params
     */
    public function posts(): array;

    /**
     * @return array all the headers
     * for get all headers
     */
    public function headers(): array;

    /**
     * @return array all the cookies
     * for get all cookies
     */
    public function cookies(): array;

    /**
     * @return array all the sessions
     * for get all get sessions
     */
    public function sessions(): array;

    /**
     * @param string|null $name name of the parameter | null
     * @return string|null|array if name funded return string or not funded return null and if name is null return array of all post parameters
     * get specific element of post params
     */
    public function post(?string $name = null): string|null|array;

    /**
     * @param string|null $name name of the header | null
     * @return string|null|array if name funded return string or not funded return null and if name is null return array of all headers
     * get specific element of header
     */
    public function header(?string $name = null): string|null|array;

    /**
     * @param string|null $name name of the parameter | null
     * @return string|null|array if name funded return string or not funded return null and if name is null return array of all get parameters
     * get specific element of post params
     */
    public function get(?string $name = null): string|null|array;

    /**
     * @param string|null $name name of the cookie | null
     * @return string|null|array if name funded return string or not funded return null and if name is null return array of all cookies
     * get specific element of cookie
     */
    public function cookie(?string $name = null): string|null|array;

    /**
     * @param string|null $name name of the session | null
     * @return string|null|array if name funded return string or not funded return null and if name is null return array of all sessions
     * get specific element of session
     */
    public function session(?string $name = null): string|null|array;

    /**
     * @return stdClass
     * get Json decoded body
     */
    public function jsonBody() : stdClass|null;

    public function body():stdClass;

}