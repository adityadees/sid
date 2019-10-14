<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Artikel</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>dash">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Artikel</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <a href="<?= base_url()?>dash/artikel/create" class="btn btn-primary mt-4">Tambah Data</a>
    </div>
</div>


<div class="wrapper wrapper-content">
    <?php echo $this->session->flashdata('msg');?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Berita / Pengumuman</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Img</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0; 
                                foreach($artikel_grab as $i) : $no++;
                                    ?>
                                    <tr class="gradeX">
                                        <td>
                                            <?= $no;?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url();?>dash/artikel/detail/<?= $i->artikel_id; ?>">
                                                <?= $i->artikel_judul;?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= substr(strip_tags($i->artikel_isi), 0,100);?>
                                        </td>
                                        <td>
                                            <?= $i->artikel_jenis;?>
                                        </td>
                                        <td>
                                            <?= date('d M Y H:i:s',strtotime($i->artikel_tanggal));?>
                                        </td>
                                        <td>
                                            <img src="<?= base_url()?>uploads/artikel/<?= $i->artikel_cover;?>" class="img-thumbnail img-md"/>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="<?= base_url();?>dash/artikel/edit/<?= $i->artikel_id; ?>">
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" data-toggle="modal" data-target="#artikel-delete<?= $i->artikel_id?>" href="#">Delete</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item"  href="<?= base_url();?>dash/artikel/detail/<?= $i->artikel_id; ?>">
                                                            Lihat Detail
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach($artikel_grab as $x) : ?>
    <div class="modal inmodal" id="artikel-delete<?= $x->artikel_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url() ?>dash/artikel/delete" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-warning modal-icon"></i>
                        <h4 class="modal-title">Are You Sure?</h4>
                        <input type="hidden" name="artikel_id" value="<?= $x->artikel_id; ?>">
                        <input type="hidden" name="artikel_cover" value="<?= $x->artikel_cover; ?>">
                        <small class="font-bold text-danger">Data yang telah dihapus tidak dapat dikembalikan !</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <input type="submit" name="artikel_delete" value="Delete" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>