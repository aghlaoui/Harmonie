<div class="ec-style ec-right-bottom">
    <!-- Start Floating Panel Container -->
    <div class="ec-panel">
        <!-- Panel Header -->
        <div class="ec-header">
            <strong>Besoin d'aide ?</strong>
            <p>Chat avec nous sur WhatsApp</p>
        </div>
        <!-- Panel Content -->
        <div class="ec-body">
            <ul>

                <?php while (have_rows('wtsp_contact', 'option')) : the_row() ?>
                    <!-- Start Single Contact List -->
                    <?php
                    $number = sanitize_text_field(get_sub_field('phone_number'));
                    $message = sanitize_text_field(get_sub_field('message'));
                    $user_id = get_sub_field('wtsp_manager');
                    $user_name = sanitize_text_field(get_userdata($user_id)->display_name);
                    $image = esc_url(get_avatar_url($user_id, array('size' => 40)));
                    ?>
                    <li>
                        <a class="ec-list" data-number="<?php echo $number ?>" data-message="<?php echo $message ?>">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="<?php echo $image ?>" class="ec-user-img" alt="Profile image">
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span><?php echo $user_name ?></span>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                <?php endwhile; ?>

            </ul>
        </div>
    </div>
    <!--/ End Floating Panel Container -->
    <!-- Start Right Floating Button-->
    <div class="ec-right-bottom">
        <div class="ec-box">
            <div class="ec-button rotateBackward">
                <img class="whatsapp" src="<?php echo get_theme_file_uri('src/images/common/whatsapp.png') ?>" alt="whatsapp icon">
            </div>
        </div>
    </div>
    <!--/ End Right Floating Button-->
</div>