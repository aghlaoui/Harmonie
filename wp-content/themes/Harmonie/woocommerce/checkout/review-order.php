<?php

/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table">
	<div class="ec-checkout-pro" style="margin-top: 15px;">
		<?php
		do_action('woocommerce_review_order_before_cart_contents');
		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_price = $_product->get_price();
			$product_subtotal = $product_price * $cart_item['quantity'];
			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
		?>
				<div class="col-sm-12 mb-6" style="margin-bottom: 10px;">
					<div class="ec-product-inner">
						<div class="ec-pro-image-outer" style="width: 65px">
							<div class="ec-pro-image">
								<a href="<?php echo esc_url(get_permalink($_product->id)); ?>" class="image">
									<img class="main-image" src="<?php echo esc_url(wp_get_attachment_image_src($_product->image_id, 'sideCartImg')[0]); ?>" alt="Product" />
								</a>
							</div>
						</div>
						<div class="ec-pro-content" style="width: calc(100% - 88px);">
							<h5 class="ec-pro-title">
								<a href="<?php echo get_permalink($_product->id); ?>" style="font-size: 15px;">
									<?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
									<?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key); ?>
								</a>
							</h5>
							<span class="ec-price">
								<span class="new-price"><?php echo $product_subtotal . ' MAD'; ?></span>
							</span>

						</div>
					</div>
				</div>
		<?php
			}
		}
		do_action('woocommerce_review_order_after_cart_contents');
		?>
	</div>


	<div class="ec-checkout-summary">

		<div class="cart-subtotal">
			<span class="text-left"><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
			<span class="text-right" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php echo number_format(WC()->cart->get_subtotal(), 2) ?> MAD</span>
		</div>

		<?php if (wc_coupons_enabled()) : ?>
			<div>
				<span class="text-left">Remise de coupon</span>
				<span class="text-right"><a class="ec-checkout-coupan">Appliquer un coupon</a></span>
			</div>
			<div class="ec-checkout-coupan-content">
				<?php if (wc_coupons_enabled()) { ?>
					<form class="ec-checkout-coupan-form" method="post">
						<input type="text" name="coupon_code" class="ec-coupan" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
						<button type="submit" class="ec-coupan-btn btn-primary" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
							<?php esc_attr_e('Apply', 'woocommerce'); ?>
						</button>
					</form>
					<?php do_action('woocommerce_cart_coupon'); ?>
				<?php } ?>
			</div>
		<?php endif; ?>
		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
				<span class="text-left"><?php wc_cart_totals_coupon_label($coupon); ?></span>
				<span class="text-right" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php hr_cart_totals_coupon_html($coupon); ?></span>
			</div>
		<?php endforeach; ?>

		<?php do_action('woocommerce_review_order_before_order_total'); ?>
		<div class="ec-checkout-summary-total">
			<span class="text-left"><?php esc_html_e('Total', 'woocommerce'); ?></span>
			<span class="text-right" data-title=" <?php esc_attr_e('Total', 'woocommerce'); ?>"><?php echo WC()->cart->get_total('float')  ?> MAD</span>
		</div>
		<?php do_action('woocommerce_review_order_after_order_total'); ?>

	</div>
</div>