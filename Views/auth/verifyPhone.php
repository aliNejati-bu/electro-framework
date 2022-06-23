<?php

use RemoteConfig\Classes\Config;

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from curvestudio.ir/adminox/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 May 2022 13:51:29 GMT -->
<head>
    <meta charset="utf-8"/>
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <?php require $base . $dirSep . "components" . $dirSep . "toastCss.php" ?>
    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet"/>
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/app-rtl.css" rel="stylesheet" type="text/css" id="app-stylesheet"/>

</head>

<body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">


<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mb-0">

                    <div class="card-body p-4">

                        <div id="playGround">
                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="index.html">
                                            <img src="/assets/images/logo-dark.png" alt="" height="30">
                                        </a>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4">تایید شماره موبایل</h5>
                                    <p class="mb-0">برای استفاده از تمامی خدمات والی وب باید حتما شماره تماس تایید شود.</p>
                                </div>

                                <div class="account-content mt-4">


                                    <div class="form-group row">
                                        <div class="col-12" id="phoneFildConteiner">
                                            <label for="phone">شماره تماس</label>
                                            <input class="form-control" type="text" name="phone" id="phone"
                                                   required=""
                                                   placeholder="شماره تلفن خود را وارد کنید.">
                                        </div>
                                    </div>

                                    <div class="form-group row text-center mt-2">
                                        <div class="col-12">
                                            <button id="sendMobileButton" class="btn btn-md btn-block btn-primary waves-effect waves-light ffiy"
                                                    type="submit">تایید شماره تماس
                                            </button>
                                        </div>
                                    </div>
                                    <p style="text-align: center;font-size: 2rem" id="loadingBox"></p>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="/assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="/assets/js/app.min.js"></script>

<?php require $base . $dirSep . "components" . $dirSep . "toastsJs.php" ?>
<script>
    let appUrl = "<?= $appUrl ?>";
    let addPhoneRoute = "<?= route("apiAddPhone") ?>" ;
    let sendVerifyCodeRoute = "<?= route("apiSendVerifyPhone") ?>" ;
    let verifyCodeRoute = "<?= route("apiVerifyPhoneCode") ?>" ;
    <?php
    $configs = Config::getInstance()->getAllConfig('auth');
    if (!isset($_SESSION[$configs['access_token_session_name']])) {
        redirect(route('login'))->with('error', 'برای درسترسی به پنل باید وارد شده باشد.')->exec();
    }
    ?>
    let token = `<?= $_SESSION[$configs['access_token_session_name']] ?>`;
    let panelRoute = '<?= route("panel") ?>';
    let verifyPhone = '<?= route("verifyPhone")  ?>';
</script>
<script src="/assets/js/sms.js"></script>
</body>


<!-- Mirrored from curvestudio.ir/adminox/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 May 2022 13:51:29 GMT -->
</html>