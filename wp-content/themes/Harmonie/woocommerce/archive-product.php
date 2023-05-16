<?php


get_header() ?>

<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row ec_breadcrumb_inner">
					<div class="col-md-6 col-sm-12">
						<h2 class="ec-breadcrumb-title">Shop</h2>
					</div>
					<div class="col-md-6 col-sm-12">
						<!-- ec-breadcrumb-list start -->
						<ul class="ec-breadcrumb-list">
							<li class="ec-breadcrumb-item"><a href="<?php echo esc_url(home_url()) ?>">Home</a></li>
							<li class="ec-breadcrumb-item active">Shop</li>
						</ul>
						<!-- ec-breadcrumb-list end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Ec breadcrumb end -->
<!-- Ec Shop page -->
<section class="ec-page-content section-space-p">
	<div class="container">
		<div class="row">
			<div class="ec-shop-rightside col-lg-9 order-lg-last col-md-12 order-md-first margin-b-30">
				<!-- Shop Top Start -->
				<?php get_template_part('template-parts/shop/shop-top-start') ?>
				<!-- Shop Top End -->
				<!-- Shop content Start -->
				<div class="shop-pro-content">
					<div class="shop-pro-inner">
						<div class="dot-spinner filter-product-spinner" style="display:none;">
							<div class="dot-spinner__dot"></div>
							<div class="dot-spinner__dot"></div>
							<div class="dot-spinner__dot"></div>
							<div class="dot-spinner__dot"></div>
							<div class="dot-spinner__dot"></div>
							<div class="dot-spinner__dot"></div>
							<div class="dot-spinner__dot"></div>
							<div class="dot-spinner__dot"></div>
						</div>
						<div class="row products-rows-items typography">
							<?php require get_theme_file_path('template-parts/shop/product/single-product.php') ?>
						</div>
					</div>

					<!-- Ec Pagination Start -->
					<?php if ($totalProducts > $posts_per_page = get_option('posts_per_page')) : ?>
						<div class="ec-pro-pagination">
							<?php
							$from = ($posts_per_page * ($paged - 1)) + 1;
							$to = $from + ($posts_per_page - 1);
							if ($to > $totalProducts) {
								$to = $totalProducts;
							}

							$boforePagination = sprintf('<span>Affichage %d-%d of %d item(s)</span>', $from, $to, $totalProducts);
							echo $boforePagination;
							echo harmoniePagination();
							?>
						</div>
					<?php endif; ?>
					<!-- Ec Pagination End -->
				</div>
				<!--Shop content End -->
			</div>
			<!-- Sidebar Area Start -->

			<div class="ec-shop-leftside col-lg-3 order-lg-first col-md-12 order-md-last">
				<?php require(get_theme_file_path('template-parts/shop/shop-sidebar.php')) ?>
			</div>
		</div>
	</div>
</section>
<!-- End Shop page -->
<?php get_footer() ?>