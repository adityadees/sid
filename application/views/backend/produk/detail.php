<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= $title; ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('dash/produk')?>">Produk</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?= $title; ?></strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">

            <div class="ibox product-detail">
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-md-5">


                            <div class="product-images">

                                <div>
                                    <div class="image-imitation">
                                        <img src="<?= base_url()?>uploads/produk/<?= $produk_grab[0]->produk_cover;?>" class="img-thumbnail" style="max-height: 450px"/>
                                 </div>
                             </div>


                         </div>

                     </div>
                     <div class="col-md-7">

                        <h2 class="font-bold m-b-xs">
                            <?= $produk_grab[0]->produk_nama?>
                        </h2>
                        <small><?= ucfirst($produk_grab[0]->produk_kategori)?></small>
                        <hr>

                        <h4>Desc</h4>

                        <div class="small text-muted">
                         <?= $produk_grab[0]->produk_desc?>
                     </div>
                     <dl class="small m-t-md">
                        <dt>Warna</dt>
                        <dd><?= ($produk_grab[0]->produk_warna != '') ? $produk_grab[0]->produk_warna : '-'; ?></dd>
                        <dt>Ukuran</dt>
                        <dd><?= ($produk_grab[0]->produk_ukuran != '') ? $produk_grab[0]->produk_ukuran : '-'; ?></dd>
                        <dt>Bahan</dt>
                        <dd><?= ($produk_grab[0]->produk_bahan != '') ? $produk_grab[0]->produk_bahan : '-'; ?></dd>
                    </dl>
                    <hr>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>