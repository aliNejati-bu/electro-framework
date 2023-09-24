<?php

use Electro\Classes\Customs;

?>
<div class="snav-menu">
    <div class="nav accordion" id="accordionSidenav">


        <div class="snav-menu-heading d-sm-none">حساب کاربری</div>

        <!-- اعلان ها -->
        <a class="nav-link d-sm-none" href="#">
            <div class="nav-link-icon"><i class="bx bx-bell "></i></div>
            اعلان ها
            <span class="badge bg-warning-soft text-warning ms-auto">4 جدید!</span>
        </a>

        <!-- پیام ها -->
        <a class="nav-link d-sm-none" href="#">
            <div class="nav-link-icon"><i class="bx bx-envelope"></i></div>
            پیام ها
            <span class="badge bg-success-soft text-success ms-auto">2 جدید!</span>
        </a>
        <div class="snav-menu-heading">داشبورد</div>
        <?php if (auth()->userModel->user_type == 0) { ?>
            <a class="nav-link pt-0 <?= Customs::$activeMenu == 'edit_profile' ? 'active' : '' ?>"
               href="<?= route('profile') ?>">
                <div class="nav-link-icon"><i class="bx bx-user"></i></div>
                ویرایش پروفایل
            </a>
        <?php } ?>

        <?php $active_cond = Customs::$activeMenu == 'orders_list' || Customs::$activeMenu == 'pending_orders' || Customs::$activeMenu == 'waiting_for_user_orders' || Customs::$activeMenu == 'processing_orders' || Customs::$activeMenu == 'ended_orders'; ?>
        <a class="nav-link <?= $active_cond ? 'active collapsed' : '' ?>" href="javascript:void(0);"
           data-bs-toggle="collapse"
           data-bs-target="#collapseMulti" aria-expanded="false" aria-controls="collapseDashboards">
            <div class="nav-link-icon"><i class="bx bx-repost"></i></div>
            سفارشات
            <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
        </a>
        <div class="collapse <?= $active_cond ? 'show' : '' ?>" id="collapseMulti"
             data-bs-parent="#accordionSidenav" style="">
            <nav class="snav-menu-nested nav accordion" id="accordionMultiPages">
                <a class="nav-link <?= Customs::$activeMenu == 'orders_list' ? 'active' : '' ?>"
                   href="<?= route('orders') ?>">لیست سفارشات</a>
                <?php if (auth()->userModel->user_type == 1) { ?>
                    <a class="nav-link <?= Customs::$activeMenu == 'pending_orders' ? 'active' : '' ?>"
                       href="<?= route('orders') ?>?status=pending">لیست سفارشات در انتظار تایید</a>
                    <a class="nav-link <?= Customs::$activeMenu == 'waiting_for_user_orders' ? 'active' : '' ?>"
                       href="<?= route('orders') ?>?status=waiting_for_user">سفارشات در انتظار ورود اطلاعات کاربر</a>
                    <a class="nav-link <?= Customs::$activeMenu == 'processing_orders' ? 'active' : '' ?>"
                       href="<?= route('orders') ?>?status=processing">سفارشات در حال پردازش</a>
                    <a class="nav-link <?= Customs::$activeMenu == 'ended_orders' ? 'active' : '' ?>"
                       href="<?= route('orders') ?>?status=ended">سفارشات پایان یافته</a>

                <?php } ?>

            </nav>
        </div>

        <?php
        if (auth()->userModel->user_type == 1) {
            ?>
            <?php $active_cond_for_users = Customs::$activeMenu == 'users_list' ?>
            <a class="nav-link <?= $active_cond_for_users ? 'active collapsed' : '' ?>" href="javascript:void(0);"
               data-bs-toggle="collapse"
               data-bs-target="#users_collapse" aria-expanded="false" aria-controls="users_collapse">
                <div class="nav-link-icon"><i class="bx bx-user"></i></div>
                کاربران
                <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
            </a>
            <div class="collapse <?= $active_cond_for_users ? 'show' : '' ?>" id="users_collapse"
                 data-bs-parent="#accordionSidenav" style="">
                <nav class="snav-menu-nested nav accordion" id="accordionMultiPages">
                    <a class="nav-link <?= Customs::$activeMenu == 'users_list' ? 'active' : '' ?>"
                       href="<?= route('list_of_users') ?>">لیست کاربران</a>
                </nav>
            </div>
            <?php
        }
        ?>


    </div>
</div>