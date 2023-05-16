<?php
// Tabs Navigation 
$details = $args['details'];
$more_details = $args['more_details'];
$reviews_tab = $args['review_tab'];
if ($details || $more_details) :
?>
    <div class="ec-single-pro-tab-nav">
        <ul class="nav nav-tabs">

            <?php if ($details) : ?>
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details" role="tablist">Detail</a>
                </li>
            <?php endif; ?>

            <?php if ($more_details) : ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo (!$details) ? 'active' : '' ?>" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info" role="tablist">More Information</a>
                </li>
            <?php endif ?>

            <?php if (comments_open()) : ?>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review" role="tablist">Reviews</a>
                </li>
            <?php endif; ?>

        </ul>
    </div>

    <div class="tab-content ec-single-pro-tab-content">

        <?php if ($details) : ?>
            <div id="ec-spt-nav-details" class="tab-pane fade show active">
                <div class="ec-single-pro-tab-desc">
                    <p>
                        <?php echo nl2br($details) ?>
                    </p>
                </div>
            </div>
        <?php endif ?>

        <?php if ($more_details) : ?>
            <div id="ec-spt-nav-info" class="tab-pane fade <?php echo (!$details) ? 'show active' : '' ?>">
                <div class="ec-single-pro-tab-moreinfo">
                    <p>
                        <?php echo nl2br($more_details) ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <?php
        if (comments_open()) {
            call_user_func($reviews_tab['callback'], 'reviews', $reviews_tab);
        }
        ?>
    </div>
<?php endif; ?>