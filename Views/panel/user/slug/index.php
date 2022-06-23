<!DOCTYPE html>
<html lang="fa">

<head>
    <?php require $base . $dirSep . "components" . $dirSep . "toastCss.php" ?>
    <link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css"/>
    <?php require viewPath("panel>layout>heade") ?>

    <title>slugs</title>
</head>

<body>

<!-- Begin page -->
<div id="wrapper">


    <!-- Topbar Start -->
    <?php require viewPath("panel>layout>nav") ?>
    <!-- end Topbar -->


    <!-- ========== Left Sidebar Start ========== -->
    <?php require viewPath("panel>sideMenu") ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">خانه</a></li>
                                    <li class="breadcrumb-item active">لیست اسلاگ ها</li>
                                </ol>
                            </div>
                            <h4 class="page-title">
                                لیست اسلاگ های ساخته شده.
                            </h4>

                            <!--<div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal">مودال استاندارد</button>
                                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="myModalLabel">عنوان مودال</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>متن را به صورت مودال ارسال کنید</h5>
                                                    <p>فیلم نرم است ، هیچ عزاداری وجود ندارد ، مگر اینکه راه خلاقانه ای در اطراف وجود داشته باشد.</p>
                                                    <hr>
                                                    <h5>سرریز کردن متن برای نشان دادن رفتار پیمایش</h5>
                                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">بستن</button>
                                                    <button type="button" class="btn btn-primary waves-effect waves-light">ذخیره تغییرات</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <div class="card__header_container">
                                <h4 class="header-title">لیست اسلاگ ها</h4>


                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                        data-toggle="modal" data-target="#create">ایجاد اسلاگ جدید
                                </button>
                                <div id="create" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">ایجاد اسلاگ جدید</h4>
                                            </div>
                                            <form method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">آدرس
                                                            اسلاگ</label>
                                                        <input value="<?= $randomString ?>" type="text"
                                                               class="form-control"
                                                               name="slug"
                                                               id="inputAddress"
                                                               placeholder="آدرس اسلاگ">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">لینک حدف
                                                            اسلاگ</label>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="target_link"
                                                               id="inputAddress"
                                                               placeholder="آدرس هدف"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect"
                                                            data-dismiss="modal">بستن
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">
                                                        ذخیره تغییرات
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="datatable"
                                                           class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                                                           style="border-collapse: collapse; border-spacing: 0px; width: 100%;"
                                                           role="grid" aria-describedby="datatable_info">

                                                        <thead>
                                                        <tr role="row">
                                                            <th class="sorting_asc" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 20.4px;"
                                                                aria-label="شناسه: activate to sort column descending"
                                                                aria-sort="ascending">شناسه
                                                            </th>
                                                            <th class="sorting_asc" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 60.4px;"
                                                                aria-label="نام کوتاه: activate to sort column descending"
                                                                aria-sort="ascending">نام کوتاه
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 164.4px;"
                                                                aria-label="لینک: activate to sort column ascending">
                                                                لینک
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 164.4px;"
                                                                aria-label="مستقیم: activate to sort column ascending">
                                                                مستقیم
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 100.4px;"
                                                                aria-label="تعداد کلیک: activate to sort column ascending">
                                                                تعداد کلیک
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 146.4px;"
                                                                aria-label="تاریخ ایجاد: activate to sort column ascending">
                                                                تاریخ ایجاد
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 146.4px;"
                                                                aria-label="عملیات: activate to sort column ascending">
                                                                عملیات
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php

                                                        foreach ($slugs as $slug) {
                                                            ?>
                                                            <tr role="row" class="odd">
                                                                <td><?= $slug->id ?></td>
                                                                <td><?= $slug->slug ?></td>
                                                                <td><a href="<?= $url . "/" . $slug->slug ?>">کلیک
                                                                        کنید</a></td>
                                                                <td><?= $slug->is_direct ? '<span class="badge label-table badge-success">لینک مستقیم</span>' : '<span class="badge label-table badge-danger">مستقیم نیست</span>' ?></td>
                                                                <td><?= $slug->clicksCount() ?></td>
                                                                <td><?= $slug->created_at ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button type="button"
                                                                                class="btn btn-warning dropdown-toggle waves-effect"
                                                                                data-toggle="dropdown"
                                                                                aria-expanded="false"> عملیات <i
                                                                                    class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" data-toggle="modal"
                                                                               data-target="#create_link_<?= $slug->id ?>"
                                                                               href="#">ایجاد لینک</a>
                                                                            <a class="dropdown-item" data-toggle="modal"
                                                                               data-target="#link_list_<?= $slug->id ?>"
                                                                               href="#">لیست لینک ها</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <!-- Create Link -->
                                                            <div id="create_link_<?= $slug->id ?>" class="modal fade"
                                                                 tabindex="-1" role="dialog" aria-hidden="true">

                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-hidden="true">×
                                                                            </button>
                                                                            <h4 class="modal-title" id="myModalLabel">
                                                                                ایجاد لینک جدید</h4>
                                                                        </div>
                                                                        <form method="post"
                                                                              action="<?= route("addLink") ?>">
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label for="inputAddress"
                                                                                           class="col-form-label">آدرس
                                                                                        مقصد</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="target_link"
                                                                                           id="inputAddress"
                                                                                           placeholder="آدرس مقصد"
                                                                                           required>
                                                                                    <input type="hidden" name="slug_id"
                                                                                           value="<?= $slug->id ?>">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="inputAddress"
                                                                                           class="col-form-label">
                                                                                     ترتیب</label>
                                                                                    <input type="number"
                                                                                           class="form-control"
                                                                                           name="order"
                                                                                           id="inputAddress"
                                                                                           placeholder="ترتیب"
                                                                                           required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary waves-effect"
                                                                                        data-dismiss="modal">بستن
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-primary waves-effect waves-light">
                                                                                    ذخیره تغییرات
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <?php
                                                        }

                                                        ?>


                                                        </tbody>
                                                    </table>
                                                    <?php
                                                    foreach ($slugs as $slug) {
                                                        ?>
                                                        <div id="link_list_<?= $slug->id ?>" class="modal fade"
                                                             tabindex="-1" role="dialog" aria-hidden="true">

                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-hidden="true">×
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                            ایجاد لینک جدید</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card-box">
                                                                            <h4 class="header-title">لیست همه اسلاگ های
                                                                                این لینک</h4>
                                                                            <p class="sub-header">
                                                                                در این مودال همه لینک های سلاگ را
                                                                                میبینید.
                                                                            </p>

                                                                            <div class="table-responsive">

                                                                                <table class="table table-striped mb-0">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>شناسه لینک</th>
                                                                                        <th>آردس هدف</th>
                                                                                        <th>تعداد کلیک ها</th>
                                                                                        <th>ترتیب</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php foreach ($slug->links as $link): ?>
                                                                                        <tr>
                                                                                            <th scope="row"><?= $link->id ?> </th>
                                                                                            <td>
                                                                                                <a href="<?= $link->target_link ?>"><?= $link->target_link ?></a>
                                                                                            </td>
                                                                                            <td><?= $link->clicksCount() ?></td>
                                                                                            <td><?= $link->order ?></td>
                                                                                        </tr>
                                                                                    <?php endforeach; ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-secondary waves-effect"
                                                                                data-dismiss="modal">بستن
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="btn btn-primary waves-effect waves-light">
                                                                            ذخیره تغییرات
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    } ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div> <!-- end container-fluid -->

        </div> <!-- end content -->


        <!-- Footer Start -->
        <?php require viewPath("panel>layout>footer") ?>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Vendor js -->
<script src="/assets/js/vendor.min.js"></script>

<!-- Required datatable js -->
<script src="/assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="/assets/libs/datatables/dataTables.buttons.min.js"></script>
<script src="/assets/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="/assets/libs/jszip/jszip.min.js"></script>
<script src="/assets/libs/pdfmake/pdfmake.min.js"></script>
<script src="/assets/libs/pdfmake/vfs_fonts.js"></script>
<script src="/assets/libs/datatables/buttons.html5.min.js"></script>
<script src="/assets/libs/datatables/buttons.print.min.js"></script>
<script src="/assets/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="/assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatables init -->
<script src="/assets/js/pages/datatables.init.js"></script>

<!-- App js -->
<script src="/assets/js/app.min.js"></script>
<?php require $base . $dirSep . "components" . $dirSep . "toastsJs.php" ?>
</body>
<?php
// TODO: اضافه کردن ترتیب لینک ها
// TODO: ایجاد لینک های مستقیم
// TODO: ویرایش اسلاگ
?>
</html>