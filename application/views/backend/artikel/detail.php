<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Artikel</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>dash">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>dash/artikel">Artikel</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detail</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight article">
    <div class="row justify-content-md-center">
        <div class="col-lg-10">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="float-right">
                        <button class="btn btn-primary btn-xs" type="button"><?= $artikel_grab[0]->artikel_jenis; ?></button>
                    </div>
                    <div class="text-center article-title">
                        <span class="text-muted"><i class="fa fa-clock-o"></i> <?= date('d M Y',strtotime($artikel_grab[0]->artikel_tanggal)); ?></span>
                        <h1>
                            <?= $artikel_grab[0]->artikel_judul ?>
                        </h1>
                    </div>

                    <?= $artikel_grab[0]->artikel_isi ?>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="small text-right">
                                <h5>Stats:</h5>
                                <i class="fa fa-eye"> </i> <?= $artikel_grab[0]->artikel_views ?> views
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>