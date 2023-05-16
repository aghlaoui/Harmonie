<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;

?>
<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row ec_breadcrumb_inner">
					<div class="col-md-6 col-sm-12">
						<h2 class="ec-breadcrumb-title">Confirmation</h2>
					</div>
					<div class="col-md-6 col-sm-12">
						<!-- ec-breadcrumb-list start -->
						<ul class="ec-breadcrumb-list">
							<li class="ec-breadcrumb-item"><a href="<?php echo home_url() ?>">Home</a></li>
							<li class="ec-breadcrumb-item active">Confirmation</li>
						</ul>
						<!-- ec-breadcrumb-list end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="ec-page-content section-space-p ec-user-account">
	<div class="container woocommerce-order">
		<div class="row">
			<div class="ec-shop-rightside col-lg-12 col-md-12 d-flex justify-content-center">
				<div class="ec-vendor-dashboard-card" style="border: 1px solid #ccc;padding: 14px;border-radius: 8px 8px 0px 0px;">
					<div class="ec-vendor-card-body padding-b-0 typography">
						<div class="page-content">
							<?php
							if ($order) :

								do_action('woocommerce_before_thankyou', $order->get_id());
							?>

								<?php if ($order->has_status('failed')) : ?>

									<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

									<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
										<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
										<?php if (is_user_logged_in()) : ?>
											<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
										<?php endif; ?>
									</p>

								<?php else : ?>
									<div class="page-header text-blue-d2">
										<?php $logo = (is_ssl()) ? str_replace('http://', 'https://', get_theme_mod('site_logo')) : get_theme_mod('site_logo') ?>
										<img src="<?php echo $logo ?>" alt="Site Logo">
									</div>
									<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
									<h5 style="text-align: center;" class="ec-fw-bold ec-fc">
										<?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), $order); ?>
									</h5>
									</p>

									<div class="page-header text-blue-d2">
										<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

											<li class="woocommerce-order-overview__order order">
												<?php esc_html_e('Order number:', 'woocommerce'); ?>
												<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
														?></strong>
											</li>

											<li class="woocommerce-order-overview__date date">
												<?php esc_html_e('Date:', 'woocommerce'); ?>
												<strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
														?></strong>
											</li>

											<?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
												<li class="woocommerce-order-overview__email email">
													<?php esc_html_e('Email:', 'woocommerce'); ?>
													<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
															?></strong>
												</li>
											<?php endif; ?>

											<li class="woocommerce-order-overview__total total">
												<?php esc_html_e('Total:', 'woocommerce'); ?>
												<strong><?php echo $order->get_total() . ' MAD'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
														?></strong>
											</li>

											<?php if ($order->get_payment_method_title()) : ?>
												<li class="woocommerce-order-overview__payment-method method">
													<?php esc_html_e('Payment method:', 'woocommerce'); ?>
													<strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
												</li>
											<?php endif; ?>

										</ul>
									</div>
								<?php endif; ?>
								<?php // do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); 
								?>
								<?php do_action('woocommerce_thankyou', $order->get_id()); ?>

							<?php else : ?>

								<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
									<?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); ?>
								</p>

							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>