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
        <a href="#" data-toggle="modal" data-target="#galeri_add" class="btn btn-primary mt-4">Tambah Data</a>
    </div>
</div>


<div class="wrapper wrapper-content">
    <?php echo $this->session->flashdata('msg');?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?= $title; ?></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="lightBoxGallery">
                        <?php foreach($galeri as $i):?>
                            <a href="<?= base_url('uploads/galeri/'.$i->galeri_foto)?>" data-gallery="">
                                <img src="<?= base_url('uploads/galeri/'.$i->galeri_foto)?>" style="width: 100px;height: 100px">
                            </a>
                        <?php endforeach; ?>
                        <div id="blueimp-gallery" class="blueimp-gallery">
                            <div class="slides"></div>
                            <h3 class="title"></h3>
                            <a class="prev">‹</a>
                            <a class="next">›</a>
                            <a class="close">×</a>
                            <a class="play-pause"></a>
                            <ol class="indicator"></ol>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="galeri_add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url() ?>index.php/backend/galeri/create" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="custom-file">
                            <input id="logo" type="file" name="filefoto" class="custom-file-input" required="" accept=".jpg,.jpeg,.png">
                            <label for="logo" class="custom-file-label">Choose file...</label>
                            <span class="text-danger">* Format harus berupa .jpg atau .png</span>
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

<div class="modal inmodal" id="slider_edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url() ?>index.php/backend/slider/edit" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
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


<div class="modal inmodal" id="slider_delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url() ?>index.php/backend/slider/delete" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
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
                    <input type="submit" name="slider_delete" value="Delete" class="btn btn-primary">
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