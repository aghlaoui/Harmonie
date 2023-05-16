<?php

use Automattic\Jetpack\Constants;

/**
 * Get coupon display HTML.
 *
 * @param string|WC_Coupon $coupon Coupon data or code.
 */
function hr_cart_totals_coupon_html($coupon)
{
    if (is_string($coupon)) {
        $coupon = new WC_Coupon($coupon);
    }

    $discount_amount_html = '';

    $amount               = WC()->cart->get_coupon_discount_amount($coupon->get_code(), WC()->cart->display_cart_ex_tax);
    $discount_amount_html = '-' . number_format($amount, 2) . ' MAD';

    if ($coupon->get_free_shipping() && empty($amount)) {
        $discount_amount_html = __('Free shipping coupon', 'woocommerce');
    }

    // $discount_amount_html = apply_filters('woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon);
    $coupon_html          = $discount_amount_html . ' <a href="' . esc_url(add_query_arg('remove_coupon', rawurlencode($coupon->get_code()), Constants::is_defined('WOOCOMMERCE_CHECKOUT') ? wc_get_checkout_url() : wc_get_cart_url())) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr($coupon->get_code()) . '">' . __('[Remove]', 'woocommerce') . '</a>';

    echo wp_kses(apply_filters('woocommerce_cart_totals_coupon_html', $coupon_html, $coupon, $discount_amount_html), array_replace_recursive(wp_kses_allowed_html('post'), array('a' => array('data-coupon' => true)))); // phpcs:ignore PHPCompatibility.PHP.NewFunctions.array_replace_recursiveFound
}


/**
 * Get a shipping methods full label including price.
 *
 * @param  WC_Shipping_Rate $method Shipping method rate data.
 * @return string
 */
function hr_cart_totals_shipping_method_label($method)
{
    $label     = $method->get_label();
    $has_cost  = 0 < $method->cost;
    $hide_cost = !$has_cost && in_array($method->get_method_id(), array('free_shipping', 'local_pickup'), true);

    if ($has_cost && !$hide_cost) {
        if (WC()->cart->display_prices_including_tax()) {
            $label .= ': ' . number_format($method->cost + $method->get_shipping_tax(), 2) . ' MAD';
            if ($method->get_shipping_tax() > 0 && !wc_prices_include_tax()) {
                $label .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>';
            }
        } else {
            $label .= ': ' . number_format($method->cost, 2) . ' MAD';
            if ($method->get_shipping_tax() > 0 && wc_prices_include_tax()) {
                $label .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
            }
        }
    }

    return apply_filters('woocommerce_cart_shipping_method_full_label', $label, $method);
}


remove_action('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);
add_action('woocommerce_cart_is_empty', 'hr_empty_cart_message', 10);
/**
 * Show notice if cart is empty.
 *
 * @since 3.1.0
 */
function hr_empty_cart_message()
{
    echo '<div class="alert alert-dark" style="border-radius: unset;">' . wp_kses_post(apply_filters('wc_empty_cart_message', __('Your cart is currently empty.', 'woocommerce'))) . '</div>';
}
