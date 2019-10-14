<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Artikel</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>dash">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>index.php/dash/artikel">Artikel</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Artikel</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<form method="POST" action="<?= base_url()?>index.php/backend/artikel/create" enctype="multipart/form-data">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                <div class="form-group">
                                    <input type="text" name="judul" placeholder="Judul" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                <div class="form-group">
                                    <input type="submit" name="save_artikel" value="Publish" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Isi Berita / Pengumuman</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <textarea class="summernote" name="isi" ></textarea>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Option</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label>Jenis Artikel</label> 
                            <select name="jenis" class="form-control">
                                <option value="news">News</option>
                                <option value="info">Info</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Heading Image</label> 
                            <div class="custom-file">
                                <input id="logo" type="file" name="filefoto" required="required" class="custom-file-input">
                                <label for="logo" class="custom-file-label">Choose file...</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>