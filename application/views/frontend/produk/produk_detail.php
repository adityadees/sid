<div class="portfolio-ajax-page">
	<div class="row">
		<div class="col-lg-7">
			<div class="carousel arrows-grey arrows-only arrows-visible dots-dark dots-inside" data-items="1">
				<img src="<?= base_url('uploads/produk/'.$produk_grab[0]->produk_kategori."/".$produk_grab[0]->produk_cover)?>">
				<!-- <img src="<?= base_url('uploads/produk/songket/detail/2.jpeg')?>"> -->
			</div>
		</div>
		<div class="col-lg-5">
			<div class="project-description">
				<h2><?= $produk_grab[0]->produk_nama ?></h2>
				<p><?= $produk_grab[0]->produk_desc ?></p>
				<hr>
				<div class="portfolio-attributes style1">
					<div class="attribute"><strong>Nama</strong> <?= $produk_grab[0]->produk_nama ?><</div>
					<div class="attribute"><strong>Warna</strong> <?= $produk_grab[0]->produk_warna ?><</div>
					<div class="attribute"><strong>Bahan</strong> <?= $produk_grab[0]->produk_bahan ?></div>
					<div class="attribute"><strong>Ukuran</strong> <?= $produk_grab[0]->produk_ukuran ?></div>
				</div>
				<hr>
				<div class="portfolio-share m-t-20">
					<h4>Share</h4>
					<div class="align-center">
						<a class="btn btn-xs btn-slide btn-light" href="#">
							<i class="fab fa-facebook-f"></i>
							<span>Facebook</span>
						</a>
						<a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
							<i class="fab fa-twitter"></i>
							<span>Twitter</span>
						</a>
						<a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
							<i class="fab fa-instagram"></i>
							<span>Instagram</span>
						</a>
						<a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
							<i class="far fa-envelope"></i>
							<span>Mail</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
