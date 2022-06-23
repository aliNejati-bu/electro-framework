<script src="/assets/libs/jquery-toast/jquery.toast.min.js"></script>

<?php
if (isError()) {
    ?>
    <script>

        $.toast({
            heading: "خطا در ارسال اطلاعات",
            text: "<ul><?php
                foreach (errors() as $error) {
                    echo "<li>" . $error . "</li><br>";
                }
                ?></ul>",
            position: "top-right",
            loaderBg: "#bf441d",
            icon: "error",
            hideAfter: 3e3,
            stack: 1
        })
    </script>
    <?php
}
if (isMessage()){
    ?>
    <script>

        $.toast({
            heading: "پیغام ها:",
            text: "<ul><?php
                foreach (messages() as $error) {
                    echo "<li>" . $error . "</li><br>";
                }
                ?></ul>",
            position: "top-right",
            loaderBg: "#3b98b5",
            icon: "info",
            hideAfter: 3e3,
            stack: 1
        })
    </script>
    <?php
}
?>
