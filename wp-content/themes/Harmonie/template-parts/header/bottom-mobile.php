<div class="ec-header-bottom d-lg-none">
    <div class="container position-relative">
        <div class="row ">

            <!-- Ec Header Logo Start -->
            <div class="col">
                <div class="header-logo">
                    <?php $logo = (is_ssl()) ? str_replace('http://', 'https://', esc_url(get_theme_mod('site_logo'))) : esc_url(get_theme_mod('site_logo')) ?>
                    <a href="<?php echo esc_url(home_url()) ?>">
                        <img src="<?php echo $logo ?>" alt="Site Logo" />
                        <img class="dark-logo" src="<?php echo $logo ?>" alt="Site Logo" style="display: none;" />
                    </a>
                </div>
            </div>
            <!-- Ec Header Logo End -->
            <!-- Ec Header Search Start -->
            <div class="col">
                <div class="header-search">
                    <form class="ec-btn-group-form" action="<?php echo esc_url(site_url('/')) ?>">
                        <input class="form-control ec-search-bar" placeholder="Rechercher des produits..." type="text" name="s">
                        <button class="submit" type="submit" aria-label="Search"><i class="fi-rr-search"></i></button>
                    </form>
                </div>
            </div>
            <!-- Ec Header Search End -->
        </div>
    </div>
</div>