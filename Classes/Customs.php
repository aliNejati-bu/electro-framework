<?php

namespace Electro\Classes;

class Customs
{
    /**
     * @var string[]
     */
    public static array $css = [];

    /**
     * @var string[]
     */
    public static array $js = [];

    public static string $title = 'خانه';

    public static string $activeMenu = 'home';

    public static function addCss(string $css)
    {
        self::$css[] = $css;
    }

    public static function addJs(string $js)
    {
        self::$js[] = $js;
    }
}