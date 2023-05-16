$(document).ready(function () {
    "use strict";
    /*----------------------------- Cart Page Qty Plus Minus Button  ------------------------------ */
    var CartQtyPlusMinus = $(".cart-qty-plus-minus");
    CartQtyPlusMinus.append('<div class="ec_cart_qtybtn"><div class="inc ec_qtybtn">+</div><div class="dec ec_qtybtn">-</div></div>');
    $(".cart-qty-plus-minus .ec_cart_qtybtn .ec_qtybtn").on("click", function () {
        var $cartqtybutton = $(this);
        var CartQtyoldValue = $cartqtybutton.parent().parent().find("input").val();
        if ($cartqtybutton.text() === "+") {
            var CartQtynewVal = parseFloat(CartQtyoldValue) + 1;
        } else {

            if (CartQtyoldValue > 1) {
                var CartQtynewVal = parseFloat(CartQtyoldValue) - 1;
            } else {
                CartQtynewVal = 1;
            }
        }
        $cartqtybutton.parent().parent().find("input").val(CartQtynewVal);
    });
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