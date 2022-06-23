<?php

namespace RemoteConfig\App\Controller;

use RemoteConfig\Classes\Redirect;
use RemoteConfig\Classes\ViewEngine;

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