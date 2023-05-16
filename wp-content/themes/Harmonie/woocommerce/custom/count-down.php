<?php
$start = $args['start_date'];
$end = $args['end_date'];
$stock = $args['stock'];
?>
<?php if ($end) : ?>
    <div class="ec-single-sales">
        <div class="ec-single-sales-inner">
            <?php if ($stock) : ?>
                <div class="ec-single-sales-progress">
                    <span class="ec-single-progress-desc">Dépêchez-vous ! <?php echo $stock ?> restants en stock</span>
                    <span class="ec-single-progressbar"></span>
                </div>
            <?php endif; ?>
            <div class="ec-single-sales-countdown">
                <div class="ec-single-countdown"><span data-start="<?php echo $start ?>" data-end="<?php echo $end ?>" id="ec-single-countdown"></span></div>
                <div class="ec-single-count-desc">Le temps presse !</div>
            </div>
        </div>
    </div>
<?php endif; ?>