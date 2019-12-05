<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= $title; ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>index.php/dash">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?= $title; ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <a href="<?= base_url('dash/produk/create')?>" class="btn btn-primary mt-4">Tambah Data</a>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <?php echo $this->session->flashdata('msg');?>
    <div class="row">
        <?php foreach($produk_grab as $i) :?>
            <div class="col-md-4">
                <div class="ibox">
                    <div class="ibox-content product-box active">

                        <div class="product-imitation">
                            <img src="<?= base_url('uploads/produk/'.$i->produk_kategori."/".$i->produk_cover)?>" class="no-padding img-thumbnail" style="max-height: 150px"/>
                        </div>
                        <div class="product-desc">
                            <small class="text-muted"><?= ucfirst($i->produk_kategori)?></small>

                            <a href="#" class="product-name"> <?= $i->produk_nama;?></a>



                            <div class="small m-t-xs">
                                <?php 
                                $long_string = $i->produk_desc;
                                $limited_string = limit_words($long_string, 24);
                                echo $limited_string;
                                ?> 
                            </div>
                            <div class="m-t text-righ">
                                <a href="<?= base_url('dash/produk/detail/'.$i->produk_id)?>" class="btn btn-xs btn-outline btn-primary">View More <i class="fa fa-long-arrow-right"></i> </a>
                                <a href="javascript:;" data-target="#produk_delete" data-toggle="modal" onclick="fdelete('<?= $i->produk_id?>','<?= $i->produk_nama ?>','<?= $i->produk_cover?>')" class="pull-right btn btn-xs btn-outline btn-danger"><i class="fa fa-trash"></i> </a>
                                <a href="<?= base_url('dash/produk/edit/'.$i->produk_id)?>" class="mr-2 pull-right btn btn-xs btn-outline btn-warning"><i class="fa fa-pencil"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>




    </div>
    <div class="modal inmodal" id="produk_add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="<?= base_url() ?>index.php/backend/produk/create" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <h4>Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group ">
                            <label for="inputEmail3" class="col-form-label">Nama Produk</label>
                            <input type="text" name="judul" class="form-control" required="">
                        </div>
                        <div class="form-group ">
                            <label for="inputEmail3" class="col-form-label">Kategori Produk</label>
                            <select class="select2_demo_1 form-control" name="kategori">
                                <option value="songket">Songket</option>
                                <option value="pisau">Pisau</option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="inputEmail3" class="col-form-label">Warna</label>
                            <input type="text" name="warna" class="form-control" required="">
                        </div>
                        <div class="form-group ">
                            <label for="inputEmail3" class="col-form-label">Bahan</label>
                            <input type="text" name="bahan" class="form-control" required="">
                        </div>
                        <div class="form-group ">
                            <label for="inputEmail3" class="col-form-label">Ukuran</label>
                            <input type="text" name="ukuran" class="form-control" required="">
                        </div>
                        <div class="form-group ">
                            <label for="inputEmail3" class="col-form-label">Deskripsi Produk</label>
                            <textarea class="summernote" name="isi" ></textarea>
                        </div>
                        <div class="form-group ">
                            <label for="inputEmail3" class="col-form-label">Image</label>
                            <input type="file" name="filefoto" class="form-control" required="" accept=".jpg,.jpeg,.png">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal inmodal" id="produk_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url() ?>index.php/backend/produk/edit" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                <input type="text" name="judul" class="form-control" required="" id="judul">
                                <input type="hidden" name="id" class="form-control" required="" id="id">
                                <input type="hidden" name="oldimg" class="form-control" required="" id="img">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Link</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="desk" id="desk" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="filefoto" class="form-control" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal inmodal" id="produk_delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url() ?>index.php/backend/produk/delete" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-warning modal-icon"></i>
                        <input type="hidden" name="id" id="did">
                        <input type="hidden" name="oldimg" id="dimg">
                        <h4 class="">Apakah anda yakin ingin menghapus data <span id="djudul"></span>?</h4>
                        <small class="font-bold text-danger">Data yang telah dihapus tidak dapat dikembalikan !</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <input type="submit" name="produk_delete" value="Delete" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
      function fedit(id,judul,desk,img){
        $('#id').val(id);
        $('#judul').val(judul);
        $('#desk').val(desk);
        $('#img').val(img);
    }
    function fdelete(id,judul,img){
        $('#did').val(id);
        $('#djudul').text(judul);
        $('#dimg').val(img);
    }

</script>