$("#toastr-one").click(function () {
    $.toast({
        heading: "سر بالا!",
        text: "این هشدار به توجه شما نیاز دارد، اما خیلی مهم نیست.",
        position: "top-right",
        loaderBg: "#3b98b5",
        icon: "info",
        hideAfter: 3e3,
        stack: 1
    })
}), $("#toastr-two").click(function () {
    $.toast({
        heading: "گواکامول مقدس!",
        text: "شما باید برخی از آن فیلدهای زیر را بررسی کنید.",
        position: "top-right",
        loaderBg: "#da8609",
        icon: "warning",
        hideAfter: 3e3,
        stack: 1
    })
}), $("#toastr-three").click(function () {
    $.toast({
        heading: "آفرین!",
        text: "شما با موفقیت این پیام هشدار مهم را خواندید.",
        position: "top-right",
        loaderBg: "#5ba035",
        icon: "success",
        hideAfter: 3e3,
        stack: 1
    })
}), $("#toastr-four").click(function () {
    $.toast({
        heading: "آه ضربه محکم و ناگهانی!",
        text: "چند مورد را تغییر دهید و دوباره ارسال کنید.",
        position: "top-right",
        loaderBg: "#bf441d",
        icon: "error",
        hideAfter: 3e3,
        stack: 1
    })
}), $("#toastr-five").click(function () {
    $.toast({
        heading: "چگونه مشارکت کنیم؟!",
        text: ["مخزن را چنگال کنید", "بهبود/توسعه عملکرد", "یک درخواست کشش ایجاد کنید"],
        position: "top-right",
        loaderBg: "#1ea69a",
        hideAfter: 3e3,
        stack: 1
    })
}), $("#toastr-six").click(function () {
    $.toast({
        heading: "چگونه !<em>مشارکت کنیم؟</em>?",
        text: 'آره! این به روز رسانی را بررسی کنیدویژگی «hideAfter» را روی false قرار دهید تا نان تست چسبنده شود.<a href="https://github.com/kamranahmedse/jquery-toast-plugin/commits/master"></a>.',
        hideAfter: !1,
        position: "top-right",
        loaderBg: "#1ea69a",
        stack: 1
    })
}), $("#toastr-seven").click(function () {
    $.toast({
        text: "ویژگی «hideAfter» را روی false قرار دهید تا نان تست چسبنده شود.",
        hideAfter: !1,
        position: "top-right",
        loaderBg: "#1ea69a",
        stack: 1
    })
}), $("#toastr-eight").click(function () {
    $.toast({
        text: "ویژگی «showHideTransition» را روی fade|plain|slide برای دستیابی به انتقال های مختلف تنظیم کنید",
        heading: "محو شدن انتقال",
        showHideTransition: "fade",
        position: "top-right",
        loaderBg: "#1ea69a",
        hideAfter: 3e3,
        stack: 1
    })
}), $("#toastr-nine").click(function () {
    $.toast({
        text: "ویژگی «showHideTransition» را روی fade|plain|slide برای دستیابی به انتقال های مختلف تنظیم کنید",
        heading: "انتقال اسلاید",
        showHideTransition: "slide",
        position: "top-right",
        loaderBg: "#1ea69a",
        hideAfter: 3e3,
        stack: 1
    })
}), $("#toastr-ten").click(function () {
    $.toast({
        text: "ویژگی «showHideTransition» را روی fade|plain|slide برای دستیابی به انتقال های مختلف تنظیم کنید",
        heading: "انتقال ساده",
        showHideTransition: "plain",
        position: "top-right",
        loaderBg: "#1ea69a",
        hideAfter: 3e3,
        stack: 1
    })
});