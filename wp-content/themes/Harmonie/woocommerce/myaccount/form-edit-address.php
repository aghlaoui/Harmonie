<?php

/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

$page_title = ('billing' === $load_address) ? esc_html__('Billing address', 'woocommerce') : esc_html__('Shipping address', 'woocommerce');

do_action('woocommerce_before_edit_account_address_form'); ?>

<?php if (!$load_address) : ?>
	<?php wc_get_template('myaccount/my-address.php'); ?>
<?php else : ?>
	<div class="ec-vendor-card-body">
		<div class="row">
			<h5><?php echo apply_filters('woocommerce_my_account_edit_address_title', $page_title, $load_address); ?></h5>
			<div class="ec-vendor-upload-detail">
				<form class="row g-3" method="post">

					<div class="woocommerce-address-fields">
						<?php do_action("woocommerce_before_edit_address_form_{$load_address}"); ?>

						<div class="woocommerce-address-fields__field-wrapper">
							<?php
							foreach ($address as $key => $field) {
								harmonie_form_field($key, $field, wc_get_post_data_by_key($key, $field['value']));
							}
							?>
						</div>

						<?php do_action("woocommerce_after_edit_address_form_{$load_address}"); ?>

						<div class="col-md-12 space-t-15">
							<button type="submit" class="btn btn-primary button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="save_address" value="<?php esc_attr_e('Save address', 'woocommerce'); ?>"><?php esc_html_e('Save address', 'woocommerce'); ?></button>
							<?php wp_nonce_field('woocommerce-edit_address', 'woocommerce-edit-address-nonce'); ?>
							<input type="hidden" name="action" value="edit_address" />
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php do_action('woocommerce_after_edit_account_address_form'); ?>