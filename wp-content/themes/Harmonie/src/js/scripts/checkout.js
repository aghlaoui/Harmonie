$(document).ready(function () {
    "use strict";
    /*----------------------------- Apply Coupen Toggle -------------------------------- */
    $(document).ready(function () {
        $(document).on("click", ".ec-cart-coupan", function () {
            $('.ec-cart-coupan-content').slideToggle('slow');
        });
        $(document).on("click", ".ec-checkout-coupan", function () {
            $('.ec-checkout-coupan-content').slideToggle('slow');
        });
    });
});