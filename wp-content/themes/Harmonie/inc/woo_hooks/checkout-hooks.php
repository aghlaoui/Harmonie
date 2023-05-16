<?php
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);


// Replace Payement Methods 

remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('harmonie_checkout_payement_methods', 'woocommerce_checkout_payment', 10);
