<?php
if (is_user_logged_in()) {
    wp_redirect(site_url('my-account'));
    exit;
}
?>
<?php get_header() ?>
<div class="sticky-header-next-sec  ec-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title"><?php esc_html_e('Login', 'woocommerce'); ?></h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo home_url() ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active"><?php esc_html_e('Login', 'woocommerce'); ?></li>
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
                    <h2 class="ec-bg-title"><?php esc_html_e('Login', 'woocommerce'); ?></h2>
                    <h2 class="ec-title"><?php esc_html_e('Login', 'woocommerce'); ?></h2>
                </div>
            </div>
            <div class="ec-login-wrapper">
                <div class="ec-login-container">
                    <div class="ec-login-form">
                        <form class="woocommerce-form woocommerce-form-login login" method="post">
                            <?php do_action('woocommerce_login_form_start'); ?>

                            <span class="ec-login-wrap">
                                <label><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                <input type="text" placeholder="Nom d'utilisateur ou adresse électronique " class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
                            </span>

                            <span class="ec-login-wrap">
                                <label><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                <input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Saisissez votre mot de passe" type="password" name="password" id="password" autocomplete="current-password" />
                            </span>

                            <?php do_action('woocommerce_login_form'); ?>


                            <span class="ec-login-wrap ec-login-fp">
                                <label><a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a></label>
                            </span>

                            <span class="ec-login-wrap ec-login-btn">
                                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                                <button type="submit" class="btn btn-primary woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
                                <a href="<?php echo site_url('register') ?>" class="btn btn-secondary"><?php esc_html_e('Register', 'woocommerce'); ?></a>
                            </span>
                            <?php do_action('woocommerce_login_form_end'); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php do_action('woocommerce_after_customer_login_form'); ?>
<?php get_footer() ?>