<hr>
<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">

            <div class="content col-lg-8">

                <div id="blog" class="single-post">

                    <div class="post-item">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="#">
                                    <img alt="" src="<?= base_url('uploads/artikel/'.$artikel_grab[0]->artikel_cover)?>">
                                </a>
                            </div>
                            <div class="post-item-description">
                                <h2><?= $artikel_grab[0]->artikel_judul ?></h2>
                                <div class="post-meta">
                                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?= date('d M Y',strtotime($artikel_grab[0]->artikel_tanggal)); ?></span>
                                    <span class="post-meta-comments"><a href="#"><i class="fa fa-eye"></i><?= $artikel_grab[0]->artikel_views ?> Dilihat</a></span>
                                    <span class="post-meta-category"><a href="#"><i class="fa fa-tag"></i><?= ucfirst($artikel_grab[0]->artikel_jenis); ?></a></span>
                                    <div class="post-meta-share">
                                        <a class="btn btn-xs btn-slide btn-facebook" href="#">
                                            <i class="fab fa-facebook-f"></i>
                                            <span>Facebook</span>
                                        </a>
                                        <a class="btn btn-xs btn-slide btn-twitter" href="#" data-width="100">
                                            <i class="fab fa-twitter"></i>
                                            <span>Twitter</span>
                                        </a>
                                        <a class="btn btn-xs btn-slide btn-instagram" href="#" data-width="118">
                                            <i class="fab fa-instagram"></i>
                                            <span>Instagram</span>
                                        </a>
                                        <a class="btn btn-xs btn-slide btn-googleplus" href="mailto:#" data-width="80">
                                            <i class="far fa-envelope"></i>
                                            <span>Mail</span>
                                        </a>
                                    </div>
                                </div>
                                <p>
                                    <?= $artikel_grab[0]->artikel_isi ?>
                                </p>
                            </div>

<!-- 
                            <div class="post-navigation">
                                <a href="#" class="post-prev">
                                    <div class="post-prev-title"><span>Previous Post</span>PV1</div>
                                </a>
                                <a href="#" class="post-all">
                                    <i class="icon-grid"> </i>
                                </a>
                                <a href="#" class="post-next">
                                    <div class="post-next-title"><span>Next Post</span>Nv1</div>
                                </a>
                            </div>
                        -->

                        </div>
                    </div>

                </div>
            </div>


            <div class="sidebar sticky-sidebar col-lg-4">

                <div class="row">
                    <div class="col-lg-12 p-cb">
                        <div class="widget "> 
                            <div class="tabs">
                                <ul class="nav nav-tabs nav-justified" id="tabs-posts" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#popular" role="tab" aria-controls="popular" aria-selected="true">Populer</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="false">Recent</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#random" role="tab" aria-controls="random" aria-selected="false">Random</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tabs-posts-content">
                                    <div class="tab-pane fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                                        <div class="post-thumbnail-list">
                                            <?php foreach($popular_grab as $i) : ?>
                                                <div class="post-thumbnail-entry">
                                                    <img alt="" src="<?= base_url('uploads/artikel/'.$i->artikel_cover);?>">
                                                    <div class="post-thumbnail-content">
                                                        <a href="<?= base_url('artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
                                                            <?php
                                                            $long_string = $i->artikel_judul;
                                                            $limited_string = limit_words($long_string, 6);
                                                            echo $limited_string;
                                                            ?>
                                                        </a>
                                                        <span class="post-date"><i class="far fa-clock"></i> <?= date('d-m-Y',strtotime($i->artikel_tanggal)) ?></span>
                                                        <span class="post-category"><i class="fa fa-tag"></i> <?= ucfirst($i->artikel_jenis) ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="recent" role="tabpanel" aria-labelledby="recent-tab">
                                        <div class="post-thumbnail-list">
                                            <?php foreach($postall_grab as $i) : ?>
                                                <div class="post-thumbnail-entry">
                                                    <img alt="" src="<?= base_url('uploads/artikel/'.$i->artikel_cover);?>">
                                                    <div class="post-thumbnail-content">
                                                        <a href="<?= base_url('artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
                                                            <?php
                                                            $long_string = $i->artikel_judul;
                                                            $limited_string = limit_words($long_string, 6);
                                                            echo $limited_string;
                                                            ?>
                                                        </a>
                                                        <span class="post-date"><i class="far fa-clock"></i> <?= date('d-m-Y',strtotime($i->artikel_tanggal)) ?></span>
                                                        <span class="post-category"><i class="fa fa-tag"></i> <?= ucfirst($i->artikel_jenis) ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="random" role="tabpanel" aria-labelledby="random-tab">
                                        <div class="post-thumbnail-list">
                                            <?php foreach($random_grab as $i) : ?>
                                                <div class="post-thumbnail-entry">
                                                    <img alt="" src="<?= base_url('uploads/artikel/'.$i->artikel_cover);?>">
                                                    <div class="post-thumbnail-content">
                                                        <a href="<?= base_url('artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
                                                            <?php
                                                            $long_string = $i->artikel_judul;
                                                            $limited_string = limit_words($long_string, 6);
                                                            echo $limited_string;
                                                            ?>
                                                        </a>
                                                        <span class="post-date"><i class="far fa-clock"></i> <?= date('d-m-Y',strtotime($i->artikel_tanggal)) ?></span>
                                                        <span class="post-category"><i class="fa fa-tag"></i> <?= ucfirst($i->artikel_jenis) ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
