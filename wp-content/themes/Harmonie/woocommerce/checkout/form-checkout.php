<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}
$order_button_text  = apply_filters('woocommerce_order_button_text', __('Place order', 'woocommerce'));

wc_get_template('checkout/breadcrumb.php');


do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

?>
<section class="checkout_page ec-page-content section-space-p">
	<div class="container">
		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="ec-checkout-leftside col-lg-8 col-md-12 ">
					<!-- checkout content Start -->
					<div class="ec-checkout-content">
						<div class="ec-checkout-inner">
							<div class="ec-checkout-wrap margin-bottom-30 padding-bottom-3">
								<div class="ec-checkout-block ec-check-bill">


									<?php if ($checkout->get_checkout_fields()) : ?>

										<?php do_action('woocommerce_checkout_before_customer_details'); ?>

										<div class="col2-set" id="customer_details">

											<?php do_action('woocommerce_checkout_billing'); ?>



											<?php do_action('woocommerce_checkout_shipping'); ?>

										</div>

										<?php do_action('woocommerce_checkout_after_customer_details'); ?>

									<?php endif; ?>

								</div>
							</div>
							<!-- place order button -->
							<span class="ec-check-order-btn form-row place-order">
								<noscript>
									<?php
									/* translators: $1 and $2 opening and closing emphasis tags respectively */
									printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'), '<em>', '</em>');
									?>
									<br /><button type="submit" class="btn btn-primary alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
								</noscript>

								<?php wc_get_template('checkout/terms.php'); ?>

								<?php do_action('woocommerce_review_order_before_submit'); ?>

								<?php echo apply_filters('woocommerce_order_button_html', '<button type="submit" class="btn btn-primary alt' . esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') . '" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'); // @codingStandardsIgnoreLine 
								?>

								<?php do_action('woocommerce_review_order_after_submit'); ?>

								<?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
							</span>
						</div>
					</div>
				</div>
				<div class="ec-checkout-rightside col-lg-4 col-md-12">
					<div class="ec-sidebar-wrap ec-checkout-del-wrap">
						<div class="ec-sidebar-block">
							<div class="ec-sb-title">
								<h3 class="ec-sidebar-title">Méthode de livraison</h3>
							</div>
							<div class="ec-sb-block-content">
								<div class="ec-checkout-del">
									<div class="ec-del-desc">Veuillez sélectionner le mode d'expédition préféré pour cette commande.</div>
									<!-- shipping methods -->
									<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

										<?php do_action('woocommerce_review_order_before_shipping'); ?>

										<?php wc_cart_totals_shipping_html(); ?>

										<?php do_action('woocommerce_review_order_after_shipping'); ?>

									<?php endif; ?>
									<!-- additional note section -->
									<div class="woocommerce-additional-fields">
										<?php do_action('woocommerce_before_order_notes', $checkout); ?>

										<?php if (apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes'))) : ?>

											<?php if (!WC()->cart->needs_shipping() || wc_ship_to_billing_address_only()) : ?>

												<h3><?php esc_html_e('Additional information', 'woocommerce'); ?></h3>

											<?php endif; ?>

											<span class="ec-del-commemt woocommerce-additional-fields__field-wrapper">
												<?php foreach ($checkout->get_checkout_fields('order') as $key => $field) : ?>
													<?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
												<?php endforeach; ?>
											</span>

										<?php endif; ?>

										<?php do_action('woocommerce_after_order_notes', $checkout); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ec-sidebar-wrap">
						<div class="ec-sidebar-block">
							<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
							<div class="ec-sb-title">
								<h3 style="font-size: 20px;" class="ec-sidebar-title" id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>
							</div>

							<?php do_action('woocommerce_checkout_before_order_review'); ?>

							<div id="order_review" class="ec-sb-block-content woocommerce-checkout-review-order">
								<?php do_action('woocommerce_checkout_order_review'); ?>
							</div>

							<?php do_action('woocommerce_checkout_after_order_review'); ?>



							<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
						</div>
					</div>

					<?php do_action('harmonie_checkout_payement_methods') ?>
				</div>

			</div>
		</form>
	</div>
</section>