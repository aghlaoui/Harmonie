  <!-- Footer Start -->
  <footer class="ec-footer section-space-mt">
      <div class="footer-container">
          <div class="footer-offer">
              <div class="container">
                  <div class="row">
                      <div class="text-center footer-off-msg">
                          <span><?php echo sanitize_text_field(get_theme_mod('offer_text')) ?></span>
                          <?php
                            $offer_id = get_theme_mod('offer_link');
                            $offer_url = (!empty(get_theme_mod('offer_link'))) ? esc_url(get_permalink($offer_id)) : '#';
                            echo ' <a href="' . $offer_url . '" target="_blank">Voir les détails</a>';
                            ?>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Footer Top Start -->
          <?php get_template_part('template-parts/footer/top') ?>
          <!-- Footer Top End -->

          <!-- Footer Bottom Start -->
          <?php get_template_part('template-parts/footer/bottom') ?>
          <!-- Footer Bottom End -->
      </div>
  </footer>
  <!-- Footer Area End -->

  <!-- Footer navigation panel for responsive display -->
  <?php get_template_part('template-parts/footer/navigation-mobile') ?>
  <!-- Footer navigation panel for responsive display end -->

  <!-- Cart Floating Button -->
  <div class="ec-cart-float">
      <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
          <div class="header-icon"><i class="fi-rr-shopping-basket"></i>
          </div>
          <span class="ec-cart-count cart-count-lable">3</span>
      </a>
  </div>
  <!-- Cart Floating Button end -->

  <!-- Whatsapp -->
  <?php get_template_part('template-parts/footer/whatsapp') ?>
  <!-- Whatsapp end -->

  <?php wp_footer() ?>

  </body>

  </html>