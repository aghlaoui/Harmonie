<?php

/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     7.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (is_user_logged_in()) {
	return;
}

?>

<section class="ec-page-content section-space-p checkout_page" style="padding-bottom: 15px;">
	<div class="container">
		<div class="row">
			<div class="ec-checkout-leftside col-lg-12 col-md-auto ">
				<!-- checkout content Start -->
				<div class="ec-checkout-content">
					<div class="ec-checkout-inner">
						<div class="ec-checkout-wrap">
							<div class="ec-checkout-block ec-check-login">
								<h3 class="ec-checkout-title">Client fidèle</h3>
								<div class="ec-new-desc" style="margin-bottom: 20px;max-width: 100%;">
									<?php echo ($message) ? wpautop(wptexturize($message)) : '' ?>
								</div>
								<div class="ec-check-login-form">
									<form method="post">
										<span class="ec-check-login-wrap">
											<label for="username"><?php esc_html_e('Username or email', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
											<input type="text" class="input-text" name="username" id="username" autocomplete="username" placeholder="<?php esc_html_e('Username or email', 'woocommerce'); ?>" required />
										</span>
										<span class="ec-check-login-wrap">
											<label for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
											<input class="input-text woocommerce-Input" type="password" name="password" id="password" autocomplete="current-password" placeholder="Enter your password" required />
										</span>
										<div class="clear"></div>

										<?php do_action('woocommerce_login_form'); ?>

										<span class="ec-check-login-wrap ec-check-login-btn">
											<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
											<input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>" />
											<button class="btn btn-primary woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" type="submit" name="login" value="<?php esc_attr_e('Login', 'woocommerce'); ?>"><?php esc_html_e('Login', 'woocommerce'); ?></button>

											<a class="ec-check-login-fp" href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
										</span>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>