<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_account_navigation');
?>
<div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
	<div class="ec-sidebar-wrap ec-border-box">
		<!-- Sidebar Category Block -->
		<div class="ec-sidebar-block">
			<div class="ec-vendor-block">
				<div class="ec-vendor-block-items woocommerce-MyAccount-navigation">
					<ul>
						<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
							<li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
								<a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<?php do_action('woocommerce_after_account_navigation'); ?>