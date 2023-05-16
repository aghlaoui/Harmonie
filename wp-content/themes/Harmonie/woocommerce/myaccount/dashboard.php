<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
	'span' => array()
);
?>
<div class="ec-vendor-card-body">
	<div class="row">
		<div class="col-md-12">
			<div class="ec-vendor-block-profile">
				<div class="ec-vendor-block-img space-bottom-30">
					<div class="ec-vendor-block-detail">
						<img class="v-img" src="<?php echo esc_url(get_avatar_url($current_user->ID, array('size' => 140))) ?>" alt="vendor image">
						<h5 class="name"><?php echo esc_html($current_user->display_name) ?></h5>
						<p><a href="<?php echo esc_url(wc_logout_url()) ?>">Déconnecter</a></p>
					</div>
					<p>
						<?php
						printf(
							/* translators: 1: user display name 2: logout url */
							wp_kses(__('Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce'), $allowed_html),
							'<span>' . esc_html($current_user->display_name) . '</span>',
							esc_url(wc_logout_url())
						);
						?>
					</p>
					<p style="margin-top: 17px;">
						<?php
						/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
						$dashboard_desc = __('From your account dashboard you can view your <span><a href="%1$s">recent orders</a></span>, manage your <span><a href="%2$s">billing address</a></span>, and <span><a href="%3$s">edit your password and account details</a></span>.', 'woocommerce');

						if (wc_shipping_enabled()) {
							/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
							$dashboard_desc = __('From your account dashboard you can view your <span><a href="%1$s">recent orders</a></span>, manage your <span><a href="%2$s">shipping and billing addresses</a></span>, and <span><a href="%3$s">edit your password and account details</a></span>.', 'woocommerce');
						}
						printf(
							wp_kses($dashboard_desc, $allowed_html),
							esc_url(wc_get_endpoint_url('orders')),
							esc_url(wc_get_endpoint_url('edit-address')),
							esc_url(wc_get_endpoint_url('edit-account'))
						);
						?>
					</p>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
							<h6>Vos coordonnées</h6>
							<ul>
								<li><strong>Nom d'utilisateur : </strong><?php echo sanitize_text_field($current_user->user_nicename) ?></li>
								<li><strong>Nom : </strong><?php echo sanitize_text_field($current_user->display_name) ?></li>
								<li><strong>Email : </strong><?php echo sanitize_text_field($current_user->user_email) ?></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
