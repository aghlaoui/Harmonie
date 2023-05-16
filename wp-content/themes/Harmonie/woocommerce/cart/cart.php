<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.4.0
 */

defined('ABSPATH') || exit;
?>
<div class="sticky-header-next-sec  ec-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row ec_breadcrumb_inner">
					<div class="col-md-6 col-sm-12">
						<h2 class="ec-breadcrumb-title">Cart</h2>
					</div>
					<div class="col-md-6 col-sm-12">
						<!-- ec-breadcrumb-list start -->
						<ul class="ec-breadcrumb-list">
							<li class="ec-breadcrumb-item"><a href="<?php home_url() ?>">Home</a></li>
							<li class="ec-breadcrumb-item active">Cart</li>
						</ul>
						<!-- ec-breadcrumb-list end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
do_action('woocommerce_before_cart'); ?>

<!-- Ec breadcrumb end -->
<section class="ec-page-content section-space-p">
	<div class="container">
		<div class="row">
			<div class="ec-cart-leftside col-lg-8 col-md-12 ">
				<div class="ec-cart-content">
					<div class="ec-cart-inner">
						<div class="row">
							<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
								<?php do_action('woocommerce_before_cart_table'); ?>
								<div class="table-content cart-table-content">
									<table>
										<thead>
											<tr>
												<th class="product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
												<th class="product-price"><?php esc_html_e('Price', 'woocommerce'); ?></th>
												<th class="product-quantity" style="text-align: center;"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
												<th class="product-subtotal"><?php esc_html_e('Total', 'woocommerce'); ?></th>
												<th class="product-remove"><span class="screen-reader-text"><?php esc_html_e('Remove item', 'woocommerce'); ?></span></th>

											</tr>
										</thead>
										<tbody>
											<?php do_action('woocommerce_before_cart_contents'); ?>

											<?php
											foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
												$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
												$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

												if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
													$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
											?>
													<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

														<td data-label="<?php esc_html_e('Product', 'woocommerce'); ?>" class="product-thumbnail ec-cart-pro-name">
															<?php
															$img_attributes = array("class" => "ec-cart-pro-img mr-4");
															$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('cartImg', $img_attributes), $cart_item, $cart_item_key);
															// echo $_product->get_image('cartImg'); // outputing image 
															if (!$product_permalink) {
																echo $thumbnail; // PHPCS: XSS ok.
															} else {
																printf('<a href="%s">%s %s</a>', esc_url($product_permalink), $thumbnail, $_product->get_name()); // PHPCS: XSS ok.
															}
															?>
														</td>

														<td data-label="<?php esc_html_e('Price', 'woocommerce'); ?>" class="product-price ec-cart-pro-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
															<?php

															// echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
															$priceHTML = '<span class="amount">' . $_product->get_price() . ' MAD</span>';
															echo $priceHTML;
															?>
														</td>

														<td data-label="<?php esc_html_e('Quantity', 'woocommerce'); ?>" class="product-quantity ec-cart-pro-qty" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
															<?php
															if ($_product->is_sold_individually()) {
																$min_quantity = 1;
																$max_quantity = 1;
															} else {
																$min_quantity = 0;
																$max_quantity = $_product->get_max_purchase_quantity();
															}

															$product_quantity = woocommerce_quantity_input(
																array(
																	'input_name'   => "cart[{$cart_item_key}][qty]",
																	'input_value'  => $cart_item['quantity'],
																	'max_value'    => $max_quantity,
																	'min_value'    => $min_quantity,
																	'product_name' => $_product->get_name(),
																),
																$_product,
																false
															);

															echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
															?>
														</td>

														<td data-label="<?php esc_html_e('Total', 'woocommerce'); ?>" class="product-subtotal ec-cart-pro-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
															<?php
															// echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
															// print("<pre>" . print_r(WC()->cart, true) . "</pre>");
															$product_price = $_product->get_price();
															$product_subtotal = $product_price * $cart_item['quantity'];
															echo $product_subtotal . ' MAD';
															?>
														</td>
														<td data-label="<?php esc_html_e('Remove item', 'woocommerce'); ?>" class="product-remove ec-cart-pro-remove">
															<?php
															echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
																'woocommerce_cart_item_remove_link',
																sprintf(
																	'<a href="%s" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="ecicon eci-trash-o"></i></a>',
																	esc_url(wc_get_cart_remove_url($cart_item_key)),
																	esc_html__('Remove this item', 'woocommerce'),
																	esc_attr($product_id),
																	esc_attr($_product->get_sku())
																),
																$cart_item_key
															);
															?>
														</td>
													</tr>
											<?php
												}
											}
											?>

											<?php do_action('woocommerce_cart_contents'); ?>

											<?php do_action('woocommerce_after_cart_contents'); ?>
										</tbody>
									</table>
								</div>
								<!-- under table buttons -->
								<div class="row">
									<div class="col-lg-12">
										<div class="ec-cart-update-bottom">
											<button type="submit" class="btn btn-primary" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

											<?php do_action('woocommerce_cart_actions'); ?>

											<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

											<?php do_action('woocommerce_proceed_to_checkout'); ?>
										</div>
									</div>
								</div>
								<?php do_action('woocommerce_after_cart_table'); ?>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php do_action('woocommerce_before_cart_collaterals'); ?>

			<div class="ec-cart-rightside col-lg-4 col-md-12 cart_page">
				<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action('woocommerce_cart_collaterals');
				?>
			</div>

			<?php do_action('woocommerce_after_cart'); ?>
		</div>
	</div>
</section>