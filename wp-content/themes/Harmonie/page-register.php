<?php
if (is_user_logged_in()) {
    wp_redirect(site_url('my-account'));
    exit;
}
?>
<?php get_header() ?>

<div class="sticky-header-next-sec ec-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title"><?php esc_html_e('Register', 'woocommerce'); ?></h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo home_url() ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active"><?php esc_html_e('Register', 'woocommerce'); ?></li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_before_customer_login_form'); ?>
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title"><?php esc_html_e('Register', 'woocommerce'); ?></h2>
                    <h2 class="ec-title"><?php esc_html_e('Register', 'woocommerce'); ?></h2>
                    <p class="sub-title mb-3">Créez un compte gratuitement</p>
                </div>
            </div>
            <div class="ec-login-wrapper">
                <div class="ec-login-container">
                    <div class="ec-login-form">
                        <form class="woocommerce-form woocommerce-form-register register" method="post" <?php do_action('woocommerce_register_form_tag'); ?>>
                            <?php do_action('woocommerce_register_form_start'); ?>

                            <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                                <span class="ec-login-wrap">
                                    <label><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                    <input type="text" placeholder="Entrer le nom d'utilisateur" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
                                </span>
                            <?php endif; ?>

                            <span class="ec-login-wrap">
                                <label><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                <input placeholder="Entrer adresse electronique" type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" />
                            </span>

                            <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                                <span class="ec-login-wrap">
                                    <label><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                    <input type="password" placeholder="Entrer un mot de passe" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                                </span>
                            <?php else : ?>
                                <p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>
                            <?php endif; ?>

                            <?php do_action('woocommerce_register_form'); ?>

                            <span class="ec-login-wrap ec-login-btn">
                                <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                                <button type="submit" class="btn btn-primary woocommerce-Button woocommerce-button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
                            </span>
                            <?php do_action('woocommerce_register_form_end'); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>