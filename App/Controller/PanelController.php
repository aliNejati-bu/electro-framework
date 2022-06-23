<?php

namespace Electro\App\Controller;

use Electro\Classes\Redirect;
use Electro\Classes\ViewEngine;

class PanelController
{

    /**
     * @return ViewEngine|Redirect
     */
    public function index(): ViewEngine|Redirect
    {
        $currentPage = "panel";
        return view("panel>panel", compact("currentPage"));
    }
}