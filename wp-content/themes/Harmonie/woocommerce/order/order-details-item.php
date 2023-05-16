<?php

/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
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

if (!defined('ABSPATH')) {
	exit;
}

if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
	return;
}
?>

<tr class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order)); ?>">
	<th> <span><?php echo $product->id ?></span></th>
	<td>
		<?php
		$is_visible        = $product && $product->is_visible();
		$product_permalink = apply_filters('woocommerce_order_item_permalink', $is_visible ? $product->get_permalink($item) : '', $item, $order);
		echo wp_kses_post(apply_filters('woocommerce_order_item_name', $product_permalink ? sprintf('<span><a href="%s">%s</a></span>', $product_permalink, $item->get_name()) : $item->get_name(), $item, $is_visible));
		?>
	</td>
	<td>
		<span>
			<?php
			$qty          = $item->get_quantity();
			$refunded_qty = $order->get_qty_refunded_for_item($item_id);

			if ($refunded_qty) {
				$qty_display = '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - ($refunded_qty * -1)) . '</ins>';
			} else {
				$qty_display = esc_html($qty);
			}
			echo $qty_display;
			?>
		</span>
	</td>
	<td>
		<span>
			<?php echo $product->price . ' MAD'; ?>
		</span>
	</td>
	<td>
		<span>
			<?php echo $item->get_subtotal() . ' MAD'; ?>
		</span>
	</td>

</tr>