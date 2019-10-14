<section id="page-title"  class="background-overlay-dark" data-parallax-image="<?= base_url('assets/images/bg/1.jpg')?>">
    <div class="container">
        <div class="page-title">
            <h1><?= $title ?></h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= base_url()?>" title="Home">Home</a></li>
                <li><a href="#" title="Artikel">Artikel</a></li>
                <li class="active"><a href="#"><?= $title ?></a></li>
            </ul>
        </div>
    </div>
</section>

<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            <div class="content col-lg-8">
                <div id="blog" class="post-thumbnails">
                    <?php if(count($news_grab)==0){ ?>
                        <div class="alert alert-info">
                            <strong>Maaf !</strong> Untuk saat ini belum ada postingan untuk halaman ini.
                        </div>
                    <?php } else { 
                        foreach($news_grab as $i) : ?>
                            <div class="post-item">
                                <div class="post-item-wrap">
                                    <div class="post-image">
                                        <a href="<?= base_url('index.php/artikel/detail/').$i->artikel_slug ?>">
                                            <img alt="<?= $i->artikel_judul ?>" src="<?= base_url()?>uploads/artikel/<?= $i->artikel_cover;?>"   title="<?= $i->artikel_judul ?>">
                                        </a>
                                        <span class="post-meta-category"><a href="<?= base_url(ucfirst($i->artikel_jenis))?>"><?= ucfirst($i->artikel_jenis) ?></a></span>
                                    </div>
                                    <div class="post-item-description">
                                        <span class="post-meta-date">
                                            <i class="fa fa-calendar-o"></i>
                                            <?= date('d M Y H:i:s',strtotime($i->artikel_tanggal));?>
                                        </span>
                                        <span class="post-meta-comments">
                                            <a href="#"><i class="fa fa-eye"></i><?= $i->artikel_views ?></a>
                                        </span>
                                        <h2>
                                            <a href="<?= base_url('index.php/artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
                                                <?php 
                                                $long_string = $i->artikel_judul;
                                                $limited_string = limit_words($long_string, 6);
                                                echo $limited_string;
                                                ?>
                                            </a>
                                        </h2>
                                        <p><?= substr(strip_tags($i->artikel_isi), 0,100);?></p>
                                        <a href="<?= base_url('index.php/artikel/detail/').$i->artikel_slug ?>" class="item-link">Read More <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; 
                    } ?>
                </div>
                <?= $page; ?>
            </div>

            <!-- sticky-sidebar -->
            <div class="sidebar col-lg-4">
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
                                                        <a href="<?= base_url('index.php/artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
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
                                                        <a href="<?= base_url('index.php/artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
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
                                                        <a href="<?= base_url('index.php/artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
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
