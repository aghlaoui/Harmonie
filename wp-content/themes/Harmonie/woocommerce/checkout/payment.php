<?php

/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

if (!wp_doing_ajax()) {
	do_action('woocommerce_review_order_before_payment');
}
?>
<div class="woocommerce-checkout-payment ec-sidebar-wrap ec-checkout-pay-wrap">
	<div class="ec-sidebar-block">
		<div class="ec-sb-title">
			<h3 class="ec-sidebar-title">Mode de paiement</h3>
		</div>
		<div class="ec-sb-block-content">
			<?php if (WC()->cart->needs_payment()) : ?>
				<div class="ec-checkout-pay wc_payment_methods payment_methods methods">
					<div class="ec-pay-desc">Veuillez sélectionner le mode de paiement préféré pour cette commande.</div>
					<?php
					if (!empty($available_gateways)) {
						foreach ($available_gateways as $gateway) {
							wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
						}
					} else {
						echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) . '</li>'; // @codingStandardsIgnoreLine
					}
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
if (!wp_doing_ajax()) {
	do_action('woocommerce_review_order_after_payment');
}
