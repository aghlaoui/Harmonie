<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<section class="ec-page-content section-space-p">
	<div id="product-<?php the_ID(); ?>" class="container">
		<div class="row">
			<div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">
				<!-- Single product content Start -->
				<div class="single-pro-block">
					<div class="single-pro-inner">
						<div class="row">
							<div class="myAlert-top alert-wishlist alert-danger"></div>
							<?php
							/**
							 * Hook: woocommerce_before_single_product_summary.
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							do_action('woocommerce_before_single_product_summary');
							?>

							<div class="single-pro-desc single-pro-desc-no-sidebar">
								<div class="single-pro-content">
									<?php
									/**
									 * Hook: woocommerce_single_product_summary.
									 *
									 * @hooked woocommerce_template_single_title - 5
									 * @hooked woocommerce_template_single_rating - 10
									 * @hooked woocommerce_template_single_excerpt - 20
									 * @hooked harmonie_template_single_coutdown - 21
									 * @hooked woocommerce_template_single_price - 22
									 * @hooked woocommerce_template_single_add_to_cart - 30
									 * @hooked woocommerce_template_single_meta - 40
									 * @hooked woocommerce_template_single_sharing - 50
									 * @hooked WC_Structured_Data::generate_product_data() - 60
									 */
									do_action('woocommerce_single_product_summary');
									?>
								</div>
							</div>

							<?php
							/**
							 * Hook: woocommerce_after_single_product_summary.
							 *
							 * @hooked woocommerce_output_product_data_tabs - 10
							 * @hooked woocommerce_upsell_display - 15
							 * @hooked woocommerce_output_related_products - 20
							 */
							do_action('woocommerce_after_single_product_summary');
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Related Products Section -->
<section class="section ec-releted-product section-space-p">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="section-title">
					<h2 class="ec-bg-title">Related products</h2>
					<h2 class="ec-title">Related products</h2>
					<p class="sub-title">Browse The Collection of Top Products</p>
				</div>
			</div>
		</div>
		<?php
		/**
		 * Hook: realted_products_section.
		 * 
		 * @hooked related_products_function
		 */
		do_action('realted_products_section');
		?>
	</div>
</section>
<?php do_action('woocommerce_after_single_product'); ?>