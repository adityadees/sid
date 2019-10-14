<div id="slider">
    <div id="rev_slider_22_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="restaurant" style="background-color:transparent;padding:0px;">
        <div id="rev_slider_22_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.1">
            <ul>

                <?php $i=0; foreach($slide as $sld) : $i++;?>
                <li data-index="rs-99<?= $i; ?>" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?= base_url(); ?>assets/images/slider/<?= $sld->slider_img ?>" data-rotate="0" data-saveperformance="off" data-title="Home" data-description="">
                    <img src="<?= base_url(); ?>assets/images/slider/dummy.png" alt="" width="1900" height="1267" data-lazyload="<?= base_url(); ?>assets/images/slider/<?= $sld->slider_img ?>" data-bgposition="center center" data-kenburns="on" data-duration="20000" data-ease="Power1.easeOut" data-scalestart="110" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>

                    <div class="scrolldown-animation" id="scroll-down">
                        <a class="btn btn-primary" href="<?= base_url($sld->slider_link)?>">
                        	Info Detail
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>

               <!--  <li data-index="rs-102" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?= base_url(); ?>assets/images/slider/2.png" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                    <img src="<?= base_url(); ?>assets/images/slider/dummy.png" alt="" width="1561" height="860" data-lazyload="<?= base_url(); ?>assets/images/slider/2.png" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                </li> -->
            </ul>
            <div class="tp-static-layers"></div>
            <div class="tp-bannertimer" style="height: 5px; background-color: rgba(183, 183, 183, 0.15);"></div>
        </div>
    </div>
</div>


<div class="news-ticker">
    <div class="news-ticker-title">
        <h4>Random Post</h4>
    </div>
    <div class="carousel news-ticker-content" data-margin="40" data-items="4" data-autoplay="true" data-autoplay-timeout="3000" data-loop="true" data-arrows="false" data-dots="false" data-auto-width="true">
        <?php foreach($artikel_random_grab as $i) : ?>
            <a href="<?= base_url('artikel/detail/').$i->artikel_slug ?>"><?= $i->artikel_judul ?></a>
        <?php endforeach; ?>
    </div>
</div>

<section class="background-colored text-dark p-b-40" style="background: #fcd808">
    <div id="particles-js" class="particles"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4" data-animate="fadeInUp" data-animate-delay="100">
                <div class="heading-text heading-section">
                    <h1 class="text-medium">Badan Pengelola Usaha</h1>
                </div>
            </div>
            <div class="col-lg-4 text-justify" data-animate="fadeInUp" data-animate-delay="300">Universitas Sriwijaya saat ini  telah menerapkan pengelolaan keuangan sebagai PTN Badan Layanan Umum (PK-BLU). Universitas Sriwijaya ditetapkan sebagai Instansi Pemerintah yang menerapkan Pengelolaan Keuangan Badan Layanan Umum (PK-BLU) melalui Keputusan Menteri Keuangan Republik Indonesia Nomor: 190/KMK.05/2009  tanggal 26 Mei 2009.
            </div>
            <div class="col-lg-4 text-justify" data-animate="fadeInUp" data-animate-delay="600"> Instansi Pemerintah yang Menerapkan Pengelolaan Keuangan Badan Layanan Umum (PK-BLU) bertujuan untuk meningkatkan pelayanan kepada masyarakat dalam rangka memajukan kesejahteraan umum dan mencerdaskan kehidupan bangsa dengan memberikan fleksibilitas dalam pengelolaan keuangan berdasarkan prinsip ekonomi dan produktivitas, dan penerapan praktik bisnis yang sehat.
            </div>
        </div>
    </div>
</section>

<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="heading-text heading-line">
                            <h4><a href="<?= base_url('news')?>">News</a></h4>
                        </div>
                        <?php foreach($news_limit_grab as $i) :?>
                            <div class="post-thumbnail">
                                <div class="post-thumbnail-entry">
                                    <img alt="" src="<?= base_url('uploads/artikel/'.$i->artikel_cover);?>">
                                    <div class="post-thumbnail-content">
                                        <h4>
                                            <a href="<?= base_url('artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
                                                <?php 
                                                $long_string = $i->artikel_judul;
                                                $limited_string = limit_words($long_string, 6);
                                                echo $limited_string;
                                                ?>
                                            </a>
                                        </h4>
                                        <p><?= substr(strip_tags($i->artikel_isi), 0,300);?> ...</p>
                                        <span class="post-date"><i class="far fa-clock"></i> <?= date('d M Y',strtotime($i->artikel_tanggal)) ?></span>
                                        <span class="post-category">
                                            <a href="<?= $i->artikel_jenis ?>">
                                                <i class="fa fa-tag"></i> <?= ucfirst($i->artikel_jenis) ?>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="col-md-6">
                        <div class="heading-text heading-line">
                            <h4><a href="<?= base_url('info')?>">Info</a></h4>
                        </div>
                        <?php foreach($info_limit_grab as $i) :?>
                            <div class="post-thumbnail">
                                <div class="post-thumbnail-entry">
                                    <img alt="" src="<?= base_url('uploads/artikel/'.$i->artikel_cover);?>">
                                    <div class="post-thumbnail-content">
                                        <h4>
                                            <a href="<?= base_url('artikel/detail/').$i->artikel_slug ?>" title="<?= $i->artikel_judul ?>">
                                                <?php 
                                                $long_string = $i->artikel_judul;
                                                $limited_string = limit_words($long_string, 6);
                                                echo $limited_string;
                                                ?>
                                            </a>
                                        </h4>
                                        <p><?= substr(strip_tags($i->artikel_isi), 0,300);?> ...</p>
                                        <span class="post-date"><i class="far fa-clock"></i> <?= date('d M Y',strtotime($i->artikel_tanggal)) ?></span>
                                        <span class="post-category">
                                            <a href="<?= $i->artikel_jenis ?>">
                                                <i class="fa fa-tag"></i> <?= ucfirst($i->artikel_jenis) ?>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading-text heading-line">
                            <h4 class="m-b-20">Layanan</h4>
                        </div>
                        <div class="grid-item" >
                            <!-- //layanan link -->
                            <div class="widget p-cb" id="page-title" style="background-image: url('<?= base_url('assets/images/sidemenu/ujihalal.png')?>');width:100%;height:100%; background-position: center;background-repeat: no-repeat;background-size: cover;">
                                <div class="container">
                                    <div class="page-title">
                                        <h3 class="text-light"></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="grid-item" >
                            <div class="widget p-cb" id="page-title" style="background-image: url('<?= base_url('assets/images/sidemenu/graha.png')?>');width:100%;height:100%; background-position: center;background-repeat: no-repeat;background-size: cover;">
                                <div class="container">
                                    <div class="page-title">
                                        <h3 class="text-light"></h3>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="grid-item" >
                            <a href="<?= base_url('asrama')?>">
                                <div class="widget p-cb" id="page-title" style="background-image: url('<?= base_url('assets/images/sidemenu/asrama.png')?>');width:100%;height:100%; background-position: center;background-repeat: no-repeat;background-size: cover;" title="Asrama Mahasiswa">
                                    <div class="container">
                                        <div class="page-title">
                                            <h3 class="text-light"></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="heading-text heading-line">
                            <h4 class="m-b-20">Link</h4>
                        </div>
                        <div class="grid-item" >
                            <img src="<?= base_url('assets/images/link/1.png')?>"> 
                        </div>
                        <div class="grid-item" >
                            <img src="<?= base_url('assets/images/link/2.png')?>"> 
                        </div>
                        <div class="grid-item" >
                            <img src="<?= base_url('assets/images/link/3.png')?>"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


