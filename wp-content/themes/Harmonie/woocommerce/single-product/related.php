<?php

/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */


if ($related_products) : ?>

	<div class="row margin-minus-b-30">

		<?php $count = 1; ?>

		<?php foreach ($related_products as $related_product) : ?>

			<?php
			$post_object = get_post($related_product->get_id());

			setup_postdata($GLOBALS['post'] = &$post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
			require get_theme_file_path('template-parts/shop/product/products-variables.php');
			$quickView = true;
			$box_type = 'single';

			// product box 
			require get_theme_file_path('template-parts/shop/product/product-box.php');

			// Modal 
			require get_theme_file_path('template-parts/shop/product/product-modal.php');

			$count++;
			?>

		<?php endforeach; ?>

		<?php //woocommerce_product_loop_end(); 
		?>

	</div>
<?php
endif;

wp_reset_postdata();
