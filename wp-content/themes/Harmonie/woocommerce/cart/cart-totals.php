<?php

/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>
<div class="ec-sidebar-wrap cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">
	<div class="ec-sidebar-block">
		<?php do_action('woocommerce_before_cart_totals'); ?>
		<div class="ec-sb-title">
			<h3 class="ec-sidebar-title"><?php esc_html_e('Cart totals', 'woocommerce'); ?></h3>
		</div>
		<div class="ec-sb-block-content" style="border-bottom: 1px solid #eee;">
			<h4 class="ec-ship-title">Expédition</h4>
			<div class="ec-cart-form">
				<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

					<?php do_action('woocommerce_cart_totals_before_shipping'); ?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php do_action('woocommerce_cart_totals_after_shipping'); ?>

				<?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

					<tr class="shipping">
						<th><?php esc_html_e('Shipping', 'woocommerce'); ?></th>
						<td data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>"><?php woocommerce_shipping_calculator(); ?></td>
					</tr>

				<?php endif; ?>

				<?php foreach (WC()->cart->get_fees() as $fee) : ?>
					<tr class="fee">
						<th><?php echo esc_html($fee->name); ?></th>
						<td data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php
				if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
					$taxable_address = WC()->customer->get_taxable_address();
					$estimated_text  = '';

					if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
						/* translators: %s location. */
						$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
					}

					if ('itemized' === get_option('woocommerce_tax_total_display')) {
						foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				?>
							<tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
								<th><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
									?></th>
								<td data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></td>
							</tr>
						<?php
						}
					} else {
						?>
						<tr class="tax-total">
							<th><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?></th>
							<td data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
						</tr>
				<?php
					}
				}
				?>
			</div>
		</div>
		<div class="ec-sb-block-content" style="margin-top: 19px;">
			<div class="ec-cart-summary-bottom">
				<div class="ec-cart-summary">
					<div class="cart-subtotal">
						<span class="text-left"><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
						<span class="text-right" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php echo number_format(WC()->cart->get_subtotal(), 2) ?> MAD</span>
					</div>

					<?php if (wc_coupons_enabled()) : ?>
						<div>
							<span class="text-left">Remise de coupon</span>
							<span class="text-right"><a class="ec-cart-coupan">Appliquer un coupon</a></span>
						</div>
						<div class="ec-cart-coupan-content">
							<form class="ec-cart-coupan-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
								<?php if (wc_coupons_enabled()) { ?>
									<input type="text" name="coupon_code" class="ec-coupan" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
									<button type="submit" class="ec-coupan-btn btn-primary" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
										<?php esc_attr_e('Apply', 'woocommerce'); ?>
									</button>
									<?php do_action('woocommerce_cart_coupon'); ?>
								<?php } ?>
							</form>
						</div>
					<?php endif; ?>

					<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
						<div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
							<span class="text-left"><?php wc_cart_totals_coupon_label($coupon); ?></span>
							<span class="text-right" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php hr_cart_totals_coupon_html($coupon); ?></span>
						</div>
					<?php endforeach; ?>


					<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

					<div class="ec-cart-summary-total order-total">
						<span class="text-left"><?php esc_html_e('Total', 'woocommerce'); ?></span>
						<span class="text-right" data-title=" <?php esc_attr_e('Total', 'woocommerce'); ?>"><?php echo WC()->cart->get_total('float')  ?> MAD</span>
					</div>

					<?php do_action('woocommerce_cart_totals_after_order_total'); ?>

				</div>
			</div>
		</div>

		<?php do_action('woocommerce_after_cart_totals'); ?>
	</div>
</div>