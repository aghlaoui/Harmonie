<?php

/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined('ABSPATH') || exit;

$show_shipping = !wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<div class="row woocommerce-customer-details">
	<div class="col-sm-6">
		<?php
		$data = $order->get_data();
		$Bfullname = $data['billing']['first_name'] . ' ' . $data['billing']['last_name'];
		$SHfullname = $data['shipping']['first_name'] . ' ' . $data['shipping']['last_name'];
		?>

		<?php if ($show_shipping) : ?>
			<div class="typography">
				<h6 class="ec-fw-normal ec-fc"><?php esc_html_e('Billing address', 'woocommerce'); ?></h6>
			</div>
		<?php endif; ?>

		<div class="my-2">
			<span class="text-sm text-grey-m2 align-middle">A : </span>
			<span class="text-600 text-110 text-blue align-middle"><?php echo sanitize_text_field($Bfullname) ?></span>
		</div>
		<div class="text-grey-m2">
			<div class="my-2">
				<?php echo sanitize_text_field($data['billing']['address_1']) ?>
			</div>
			<div class="my-2">
				<?php echo sanitize_text_field($data['billing']['address_2']) ?>
			</div>

			<?php if ($data['billing']['phone']) : ?>
				<div class="my-2">
					<b class="text-600">Tél : </b><?php echo sanitize_text_field($data['billing']['phone']) ?>
				</div>
			<?php endif; ?>

			<?php if ($data['billing']['email']) : ?>
				<div class="my-2">
					<b class="text-600">Email : </b><?php echo sanitize_text_field($data['billing']['email']) ?>
				</div>
			<?php endif; ?>
		</div>

	</div>

	<?php if ($show_shipping) : ?>
		<div class="col-sm-6" style="padding-left: 30%">
			<div class="typography">
				<h6 class="ec-fw-normal ec-fc"><?php esc_html_e('Shipping address', 'woocommerce'); ?></h6>
			</div>
			<div class="my-2">
				<span class="text-sm text-grey-m2 align-middle">A : </span>
				<span class="text-600 text-110 text-blue align-middle"><?php echo sanitize_text_field($SHfullname) ?></span>
			</div>
			<div class="text-grey-m2">
				<div class="my-2">
					<?php echo sanitize_text_field($data['shipping']['address_1']) ?>
				</div>
				<div class="my-2">
					<?php echo sanitize_text_field($data['shipping']['address_2']) ?>
				</div>

				<?php if ($data['shipping']['phone']) : ?>
					<div class="my-2">
						<b class="text-600">Tél : </b><?php echo sanitize_text_field($data['shipping']['phone']) ?>
					</div>
				<?php endif; ?>


			</div>
		</div>

	<?php endif; ?>

	<?php do_action('woocommerce_order_details_after_customer_details', $order); ?>
</div>