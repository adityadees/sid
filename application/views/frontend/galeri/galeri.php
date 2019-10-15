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

		<div class="grid-layout grid-3-columns" data-margin="20" data-item="grid-item" data-lightbox="gallery">

			<?php foreach($galeri as $i):?>
				<div class="grid-item">
					<a class="image-hover-zoom" href="<?= base_url('uploads/galeri/'.$i->galeri_foto)?>" data-lightbox="gallery-image"><img src="<?= base_url('uploads/galeri/'.$i->galeri_foto)?>" style="max-height: 200px"></a>
				</div>
			<?php endforeach; ?>

		</div>
		
		<div id="pagination" class="infinite-scroll">
			<a href="page-gallery-load-more-2.html"></a>
		</div>


		<div id="showMore">
			<a href="#" class="btn btn-rounded btn-light"><i class="icon-refresh-cw"></i> Load More</a>
		</div>

	</div>
</section>
