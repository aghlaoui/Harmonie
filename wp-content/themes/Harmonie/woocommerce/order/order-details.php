<?php

/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if (!$order) {
	return;
}

$order_items           = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note    = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ($show_downloads) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>

<div class="container px-0">
	<div class="row mt-4">
		<div class="col-lg-12">
			<hr class="row brc-default-l1 mx-n1 mb-4" />

			<?php
			if ($show_customer_details) {
				wc_get_template('order/order-details-customer.php', array('order' => $order));
			}
			?>

			<div class="mt-4">
				<div class="text-95 text-secondary-d3">
					<div class="ec-vendor-card-table">
						<?php do_action('woocommerce_order_details_before_order_table', $order); ?>

						<table class="table ec-table">

							<thead>
								<tr>
									<th scope="col"><?php esc_html_e('Id', 'woocommerce'); ?></th>
									<th scope="col"><?php esc_html_e('Name', 'woocommerce'); ?></th>
									<th scope="col"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
									<th scope="col"><?php esc_html_e('Price', 'woocommerce'); ?></th>
									<th scope="col"><?php esc_html_e('Total', 'woocommerce'); ?></th>
								</tr>
							</thead>

							<tbody>
								<?php
								do_action('woocommerce_order_details_before_order_table_items', $order);

								foreach ($order_items as $item_id => $item) {
									$product = $item->get_product();

									wc_get_template(
										'order/order-details-item.php',
										array(
											'order'              => $order,
											'item_id'            => $item_id,
											'item'               => $item,
											'show_purchase_note' => $show_purchase_note,
											'purchase_note'      => $product ? $product->get_purchase_note() : '',
											'product'            => $product,
										)
									);
								}

								do_action('woocommerce_order_details_after_order_table_items', $order);
								?>
							</tbody>

							<tfoot>
								<?php
								foreach ($order->get_order_item_totals() as $key => $total) {
								?>
									<tr>
										<td class="border-none" colspan="3">
											<span></span>
										</td>
										<td class="border-color" colspan="1">
											<span>
												<strong>
													<?php echo esc_html($total['label']); ?>
												</strong>
											</span>
										</td>
										<td class="border-color"><?php echo ('payment_method' === $key) ? esc_html($total['value']) : wp_kses_post($total['value']); ?></td>
									</tr>
								<?php
								}
								?>
								<?php if ($order->get_customer_note()) : ?>
									<tr>
										<td class="border-none m-m15" colspan="3">
											<span class="note-text-color">
												<?php esc_html_e('Note: ', 'woocommerce'); ?>
												<?php echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?>
											</span>
										</td>
									</tr>
								<?php endif; ?>
							</tfoot>
						</table>

						<?php do_action('woocommerce_order_details_after_order_table', $order); ?>
					</div>
				</div>
			</div>




		</div>
	</div>
</div>
<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action('woocommerce_after_order_details', $order);
