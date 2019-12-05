<div></div>
<section id="page-title"  class="background-overlay-dark" data-parallax-image="<?= base_url('assets/images/bg/1.jpg')?>">
	<div class="container">
		<div class="page-title">
			<h1><?= $title ?></h1>
		</div>
		<div class="breadcrumb">
			<ul>
				<li><a href="<?= base_url()?>" title="Home">Home</a></li>
				<li class="active"><a href="#"><?= $title ?></a></li>
			</ul>
		</div>
	</div>
</section>
<section id="page-content">
	<div class="container">
		<nav class="grid-filter gf-outline" data-layout="#portfolio">
			<ul>
				<li class="active"><a href="#" data-category="*">Show All</a></li>
				<li><a href="#" data-category=".ct-songket">Songket</a></li>
				<li><a href="#" data-category=".ct-pisau">Pisau</a></li>
			</ul>
			<div class="grid-active-title">Show All</div>
		</nav>


		<div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="0">

			<?php foreach ($produk as $i):?>
				<div class="portfolio-item img-zoom ct-<?= $i->produk_kategori?>">
					<div class="portfolio-item-wrap">
						<div class="portfolio-image">
							<a href="#"><img src="<?= base_url('uploads/produk/'.$i->produk_kategori."/".$i->produk_cover)?>" alt="" style="height: 200px;"></a>
						</div>
						<div class="portfolio-description">
							<a title="<?= $i->produk_nama ?>" data-lightbox="image" href="<?= base_url('uploads/produk/'.$i->produk_kategori."/".$i->produk_cover)?>"><i class="fa fa-plus"></i></a>
							<a data-lightbox="ajax" href="<?= base_url('p/detail/'.$i->produk_id)?>"><i class="fa fa-expand"></i></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>



		</div>

	</div>
</section>
