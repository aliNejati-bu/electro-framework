<!DOCTYPE html>
<html lang="fa" class="overflow-unset">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        <?= \Electro\Classes\Customs::$title ?>
    </title>
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/boxicons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/persian-datepicker.css"/>

    <?php
    foreach (\Electro\Classes\Customs::$css as $css) {
        ?>
        <link rel="stylesheet" href="<?php $css ?>">
        <?php
    }
    ?>

    <script defer="" src="/assets/js/feather.min.js"></script>
    <script defer="" src="/assets/js/font-awesome.min.js"></script>
    <?php includeView('components>toastCss'); ?>

</head>
<body class="nav-fixed">

<nav
        class="is-rtl topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
        id="snavAccordion">
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle">
        <i class="bx bx-menu bx-sm"></i>
    </button>
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">ویزیتال کات</a>


    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">

        <!-- Navbar Search Dropdown-->
        <!-- * * Note: * * Visible only below the lg breakpoint-->
        <li class="nav-item dropdown no-caret me-3 d-lg-none">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-search bx-sm"></i>
            </a>
            <!-- Dropdown - Search-->
            <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up"
                 aria-labelledby="searchDropdown">
                <form class="form-inline me-auto w-100">
                    <div class="input-group input-group-joined input-group-solid">
                        <input class="form-control pe-0" type="text" placeholder="جستجو ..." aria-label="Search"
                               aria-describedby="basic-addon2">
                        <div class="input-group-text"><i class="bx bx-search"></i></div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Alerts Dropdown-->
        <?php
        $allEvents = \Electro\App\Model\Event::query()->where('is_client_seen', 0)->where('user_id', auth()->userModel->id)->orderByDesc('id')->get()->all();
        ?>
        <li class="nav-item dropdown no-caret d-none d-sm-block me-3 bdr-notify">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
               href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <i class="bx bx-bell bx-sm"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownAlerts">
                <h6 class="dropdown-header bdr-notify-header">
                    <i class="bx bx-bell me-2"></i>
                    اعلان‌ها
                </h6>
                <div class="dropdown-div">

                    <?php
                    foreach ($allEvents as $event) {
                        ?>
                        <a class="dropdown-item bdr-notify-item" href="<?= route('order',$event->order_id) ?>">
                            <div class="bdr-notify-item-icon bg-warning"><i class="bx bx-wallet"></i></div>
                            <div class="bdr-notify-item-content">
                                <p>
                                    <strong><?= $event->title ?></strong>
                                    :
                                    <?= $event->description ?>
                                </p>
                                <small class="text-muted"><?= getTimeDist(strtotime($event->created_at)) ?></small>
                            </div>
                        </a>
                        <?php
                    }
                    ?>

                </div>

            </div>
        </li>

        <!-- Messages Dropdown-->
        <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
               href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false"><img class="img-fluid" src="<?= auth()->userModel->picture ?>"></a>
            <div class="dropdown-menu dropdown-menu-w15 dropdown-menu-end border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="<?= auth()->userModel->picture ?>">
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name"><?= auth()->userModel->name ?></div>
                        <div class="dropdown-user-details-email">
                            <?= auth()->userModel->phone ?>
                        </div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <div class="dropdown-item-icon"><i class="bx bx-user"></i></div>
                    حساب کاربری
                </a>
                <a class="dropdown-item" href="#">
                    <div class="dropdown-item-icon"><i class="bx bx-lock"></i></div>
                    تغییر کلمه عبور
                </a>
                <a class="dropdown-item" href="#">
                    <div class="dropdown-item-icon"><i class="bx bxs-file-txt"></i></div>
                    مشاهده لاگ سیستم
                </a>
                <a class="dropdown-item" href="<?= route('logout') ?>">
                    <div class="dropdown-item-icon"><i class="bx bx-log-out"></i></div>
                    خروج
                </a>
            </div>
        </li>

    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="snav shadow-right snav-light">
            <?php includeView('components>menu'); ?>
        </nav>
    </div>