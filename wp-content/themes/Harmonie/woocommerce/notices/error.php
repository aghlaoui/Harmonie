<?php

/**
 * Show error messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/error.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!$notices) {
	return;
}

?>

<?php foreach ($notices as $notice) : ?>
	<li class="alert alert-danger" <?php echo wc_get_notice_data_attr($notice); ?>>
		<i class="fi fi-rr-info" style="font-size: 18px; vertical-align: middle; display: inline-flex; margin-right: 9px;"></i>
		<?php echo wc_kses_notice($notice['notice']); ?>
	</li>
<?php endforeach; ?>