<?php
get_header();
$id = get_the_ID();
?>
<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">FAQ</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo esc_url(home_url()) ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">FAQ</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ec breadcrumb end -->

<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">FAQ</h2>
                    <h2 class="ec-title">FAQ</h2>
                    <p class="sub-title mb-3">Gestion du service à la clientèle</p>
                </div>
            </div>
            <?php if (have_rows('faq_questions', $id)) :   ?>
                <div class="ec-faq-wrapper">
                    <div class="ec-faq-container">
                        <?php
                        if ($title = get_field('faq_title', $id)) {
                            echo '<h2 class="ec-faq-heading">' . sanitize_text_field($title) . '</h2>';
                        }
                        ?>

                        <div id="ec-faq">
                            <?php while (have_rows('faq_questions', $id)) : the_row() ?>
                                <div class="col-sm-12 ec-faq-block">
                                    <?php
                                    $question = sanitize_text_field(get_sub_field('question'));
                                    $answer = sanitize_textarea_field(get_sub_field('answer'));

                                    printf(
                                        '<h4 class="ec-faq-title">%s</h4>
                                        <div class="ec-faq-content">
                                            <p>%s</p>
                                        </div>',
                                        $question,
                                        $answer
                                    );
                                    ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer() ?>