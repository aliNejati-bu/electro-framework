<!DOCTYPE html>
<html lang="fa">

<head>
    <link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css"/>
    <?php require viewPath("panel>layout>heade") ?>
    <title>user list</title>
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
                                    <li class="breadcrumb-item"><a href="<?= route('panel') ?>">پنل</a></li>
                                    <li class="breadcrumb-item active">لیست کاربران</li>
                                </ol>
                            </div>
                            <h4 class="page-title">صفحه شروع (خالی)</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title">مثال پیش فرض</h4>
                            <p class="sub-header">
                                DataTables بیشتر ویژگی ها را به صورت پیش فرض فعال کرده است ، بنابراین تنها کاری که باید
                                برای استفاده از آن در جداول خود انجام دهید این است که تابع ساخت را فراخوانی کنید: <code>$().DataTable();</code>.
                            </p>

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
                                                                aria-label="نام: activate to sort column descending"
                                                                aria-sort="ascending">نام
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 164.4px;"
                                                                aria-label="ایمیل: activate to sort column ascending">
                                                                ایمیل
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 164.4px;"
                                                                aria-label="شماره تلفن: activate to sort column ascending">
                                                                شماره تلفن
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 100.4px;"
                                                                aria-label="تایید شماره تماس: activate to sort column ascending">
                                                                تایید شماره تماس
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 146.4px;"
                                                                aria-label="تایید ایمیل: activate to sort column ascending">
                                                                تایید ایمیل
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 100.4px;"
                                                                aria-label="حقوق: activate to sort column ascending">
                                                                مدیر کل
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 146.4px;"
                                                                aria-label="تایید ایمیل: activate to sort column ascending">
                                                                ادمین
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable" rowspan="1"
                                                                colspan="1" style="width: 100.4px;"
                                                                aria-label="زمان ایجاد: activate to sort column ascending">
                                                                زمان ایجاد
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php foreach ($users as $user): ?>
                                                            <tr role="row" class="odd">
                                                                <td><?= $user->id ?></td>
                                                                <td><?= $user->name ?></td>
                                                                <td style="text-align: center"><?= $user->user_email ?></td>
                                                                <td style="text-align: center"><?= !is_null($user->phone) ? $user->phone : '<span class="badge label-table badge-danger">بدون شماره تلفن</span>' ?></td>
                                                                <td style="text-align: center"><?= $user->is_phone_verified ? '<span class="badge label-table badge-success">فعال</span>' : '<span class="badge label-table badge-danger">تایید نشده</span>' ?></td>
                                                                <td style="text-align: center"><?= $user->is_email_verified ? '<span class="badge label-table badge-success">فعال</span>' : '<span class="badge label-table badge-danger">تایید نشده</span>' ?></td>
                                                                <td style="text-align: center"><?= $user->is_super_admin ? '<span class="badge label-table badge-success">مدیر کل</span>' : '<span class="badge label-table badge-danger">کاربرعادی</span>' ?></td>
                                                                <td style="text-align: center"><?= $user->is_admin ? '<span class="badge label-table badge-success">مدیر</span>' : '<span class="badge label-table badge-danger">کاربرعادی</span>' ?></td>
                                                                <td style="text-align: center"><?= $user->created_at ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
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


</body>

</html>