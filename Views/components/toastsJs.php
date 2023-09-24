<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>


    function successesToast(msg) {
        Toastify({
            text: msg,
            duration: 2000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "left", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#00b09b",
            }
        }).showToast();
    }

    function basicError(msg) {
        Toastify({
            text: msg,
            duration: 2000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "left", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#b00058",
            },
        }).showToast();
    }
</script>


<?php
if (isError()) {
    ?>
    <script>


        <?php foreach (errors() as $error) {
        ?>
        basicError("<?= $error ?>")
        <?php
        }?>
    </script>
    <?php
}
if (isMessage()) {
    ?>
    <script>

        <?php foreach (messages() as $error) {
        ?>
        successesToast("<?= $error ?>")
        <?php
        }?>
    </script>
    <?php
}
?>
