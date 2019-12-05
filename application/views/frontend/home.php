					<div id="slider" class="inspiro-slider" data-height-xs="360">

						<?php $i = 0;
						foreach ($slide as $sld) : $i++; ?>

							<div class="slide" data-vide-bg="<?= base_url(); ?>assets/images/slider/<?= $sld->slider_img ?>">
								<div class="container">
									<div class="slide-captions">

										<h2 data-caption-animation="zoom-out"  class="text-light"><?= $sld->slider_judul ?></h2>
										<h4 class="m-b-40 text-light"><?= $sld->slider_deskripsi ?></h4>
										<button type="button" class="btn btn-light btn-outline"><span class="btn-label"><i class="fa fa-check"></i></span>Explore more</button>

									</div>
								</div>
							</div>
						<?php endforeach; ?>

					</div>


					<div class="call-to-action call-to-action-colored">
						<div class="container">
							<div class="row">
								<div class="col-md-2">
									<img src="<?= base_url()?>assets/images/logo/logo-icon.png" style="width: 140px;height: 110px" alt="">
								</div>
								<div class="col-lg-10">
									<h3 class="text-light ">SID Mempermudah akses informasi</h3>
									<p>Kami memiliki tujuan untuk mempermudah akses informasi kepada para penduduk desa dengan jangkauan akses yang tanpa batas dan mampu diketahui melalui internet.</p>
								</div>
							</div>
						</div>
					</div>



			<!-- 		<section id="section-blog" class="content background-grey">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="heading-text heading-line">
										<h4><a href="<?= base_url('index.php/news')?>">Berita</a></h4>
									</div>
									<div class="grid-layout post-3-columns m-b-30" data-item="post-item">
										<?php foreach($news_limit_grab as $i) :?>
											<div class="post-item border">
												<div class="post-item-wrap">
													<div class="post-image">
														<a href="#">
															<img alt="" src="<?= base_url('uploads/artikel/'.$i->artikel_cover);?>">
														</a>
														<span class="post-meta-category">
															<a href="<?= $i->artikel_jenis ?>">
																<?= ucfirst($i->artikel_jenis) ?>
															</a>
														</span>
													</div>
													<div class="post-item-description">
														<span class="post-meta-date">
															<i class="fa fa-calendar-o"></i>
															<?= date('d M Y',strtotime($i->artikel_tanggal)) ?>
														</span>
														<span class="post-meta-comments">
															<a href="#">
																<i class="fa fa-eye"></i>
																<?= $i->artikel_views." dilihat" ?>
															</a>
														</span>
														<h2>
															<a href="<?= base_url('index.php/artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
																<?php 
																$long_string = $i->artikel_judul;
																$limited_string = limit_words($long_string, 5);
																echo $limited_string;
																?>
															</a>
														</h2>
														<p><?= substr(strip_tags($i->artikel_isi), 0,75);?> ...</p>
														<a href="#" class="item-link">Read More <i class="fa fa-arrow-right"></i></a>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</section> -->



					<section id="page-content" class="sidebar-right">
						<div class="container">
							<div class="row">
								<div class="content col-lg-6">
									<div class="heading-text heading-line">
										<h4><a href="<?= base_url('index.php/news')?>">Berita</a></h4>
									</div>
									<div class="post-thumbnails">
										<?php foreach($news_limit_grab as $i) :?>
											<div class="post-item">
												<div class="post-item-wrap">
													<div class="post-image">
														<a href="#">
															<img alt="" src="<?= base_url('uploads/artikel/'.$i->artikel_cover);?>">
														</a>
														<span class="post-meta-category">
															<a href="<?= $i->artikel_jenis ?>">
																<?= ucfirst($i->artikel_jenis) ?>
															</a>
														</span>
													</div>
													<div class="post-item-description">
														<span class="post-meta-date">
															<i class="fa fa-calendar-o"></i>
															<?= date('d M Y',strtotime($i->artikel_tanggal)) ?>
														</span>
														<span class="post-meta-comments"><a href=""><i class="fa fa-eye"></i><?= $i->artikel_views." dilihat" ?></a></span>
														<h2>
															<a href="<?= base_url('index.php/artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
																<?php 
																$long_string = $i->artikel_judul;
																$limited_string = limit_words($long_string, 4);
																echo $limited_string;
																?>
															</a>
														</h2>
														<p><?= substr(strip_tags($i->artikel_isi), 0,75);?> ...</p>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="content col-lg-6">
									<div class="heading-text heading-line">
										<h4><a href="<?= base_url('index.php/info')?>">Informasi</a></h4>
									</div>
									<div class="post-thumbnails">
										<?php foreach($info_limit_grab as $i) :?>
											<div class="post-item">
												<div class="post-item-wrap">
													<div class="post-image">
														<a href="#">
															<img alt="" src="<?= base_url('uploads/artikel/'.$i->artikel_cover);?>">
														</a>
														<span class="post-meta-category">
															<a href="<?= $i->artikel_jenis ?>">
																<?= ucfirst($i->artikel_jenis) ?>
															</a>
														</span>
													</div>
													<div class="post-item-description">
														<span class="post-meta-date">
															<i class="fa fa-calendar-o"></i>
															<?= date('d M Y',strtotime($i->artikel_tanggal)) ?>
														</span>
														<span class="post-meta-comments"><a href=""><i class="fa fa-eye"></i><?= $i->artikel_views." dilihat" ?></a></span>
														<h2>
															<a href="<?= base_url('index.php/artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
																<?php 
																$long_string = $i->artikel_judul;
																$limited_string = limit_words($long_string, 4);
																echo $limited_string;
																?>
															</a>
														</h2>
														<p><?= substr(strip_tags($i->artikel_isi), 0,75);?> ...</p>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</section>


					<section>
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<div class="heading-text heading-line text-center">
										<h4>Produk Desa </h4> 
										<p>
											Desak kami memiliki beberapa UKM yang menghasilkan produk seperti songket dan pisau dapur.
										</p>
									</div>
								</div>
							</div>
							<div class="shop-category">
								<div class="row">
									<div class="col-lg-6">
										<div class="shop-category-box">
											<a href="javascript:;"><img src="<?= base_url('uploads/produk/songket/4.jpg')?>" alt="">
												<div class="shop-category-box-title text-center">
													<h6>Kaing Songket</h6><small><?= count($count_songket) ?> Jenis</small>
												</div>
											</a>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="shop-category-box">
											<a href="javascript:;"><img src="<?= base_url('uploads/produk/pisau/4.jpg')?>" alt="">
												<div class="shop-category-box-title text-center">
													<h6>Pisau</h6><small><?= count($count_pisau) ?> Jenis</small>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
