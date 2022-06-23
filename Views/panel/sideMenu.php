<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">پنل مدیریت</li>

                <li>
                    <a href="<?= route('panel') ?>">
                        <i class="fe-airplay"></i>
                        <span>داشبورد</span>
                    </a>
                </li>
                <?php if (auth()->userModel->isAdmin()): ?>
                    <li class="menu-title">مدیریت</li>


                    <?php if (auth()->userModel->isSuperAdmin() || auth()->userModel->hasPermission("Users")): ?>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">
                                <i class="far fa-user"></i>
                                <span>مدیریت کاربران</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                <li><a href="<?= route('userList') ?>">لیست کاربران</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <li class="menu-title">اسلاگ ها</li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">
                        <i class="far fa-user"></i>
                        <span>مدیریت slug ها</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level mm-collapse" aria-expanded="false">
                        <li><a href="<?= route('addSlug') ?>">اضافه کردن slug</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>