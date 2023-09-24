</div>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/scripts.js"></script>





<script src="/assets/js/persian-date.js"></script>
<script src="/assets/js/persian-datepicker.js"></script>
<script>
    $(document).ready(function () {

        $('#litepickerRangePluginAz').persianDatepicker({
            format: 'YYYY/MM/DD',
            autoClose: true
        });
        $('#litepickerRangePluginTo').persianDatepicker({
            format: '- YYYY/MM/DD',
            autoClose: true
        });

    });
</script>




<?php

use Electro\Classes\Customs;

foreach (Customs::$js as $js) {
    echo "<script src='$js'></script>";
}
?>

<?php includeView('components>toastsJs'); ?>


</body>

<!-- Mirrored from joohar.ir/sadminV1/dashboard-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Aug 2023 19:16:48 GMT -->
</html>