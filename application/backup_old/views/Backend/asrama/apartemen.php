<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= $title ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>dash">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Asrama</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?= $title ?></strong>
            </li>
        </ol>
    </div>
</div>


<div class="wrapper wrapper-content">
    <?php echo $this->session->flashdata('msg');?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Data <?= $title?></h5>
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
                                    <th>Kode</th>
                                    <th>Fasilitas</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0; 
                                foreach(json_decode($apartemen_grab) as $i) : $no++;
                                    ?>
                                    <tr class="gradeX">
                                        <td>
                                            <?= $no;?>
                                        </td>
                                        <td>
                                            <?= $i->asrama_id ?>
                                        </td>
                                        <td>
                                            <?= substr(strip_tags($i->asrama_fasilitas), 0,100);?>
                                        </td>
                                        <td>
                                            <?= substr(strip_tags($i->asrama_keterangan), 0,100);?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($i->asrama_status == 'rusak'){ ?>
                                                <label class="badge" style="background: #4e4e4e;color:white"><?= ucfirst($i->asrama_status) ?></label>
                                            <?php } else if($i->asrama_status == 'isi') { ?>
                                                <label class="badge" style="background: #d04c47;color:white"><?= ucfirst($i->asrama_status) ?></label>
                                            <?php }  else { ?>
                                                <label class="badge badge-plain"><?= ucfirst($i->asrama_status) ?></label>
                                            <?php }  ?>

                                        </td>
                                        <td class="text-center">
                                            <?php if($i->asrama_status == 'rusak'){ ?>
                                                <i class="fa fa-key btn btn-warning" title="Aktifkan Ruangan"  data-toggle="modal" data-target="#modalRuangan" onclick="fkonfirmasi('<?= $i->asrama_id?>','tersedia','Apakah anda yakin ingin mengaktifkan kembali kamar ini?')"></i>
                                            <?php } else { ?>
                                              <i class="fa fa-trash btn btn-danger" title="Aktifkan Ruangan"  data-toggle="modal" data-target="#modalRuangan" onclick="fkonfirmasi('<?= $i->asrama_id?>','rusak','Apakah anda yakin ingin menonaktifkan kamar ini?')"></i>
                                          <?php }  ?>
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



<div class="modal inmodal" id="modalRuangan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('backend/asrama/changestatus')?>" method="POST">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <p class="text-center minfo" ></p>
                    <div class="form-group">
                        <?php
                        $uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        ?>
                        <input type="hidden" name="uriseg" class="form-control" value="<?= $uri; ?>">
                        <input type="hidden" name="id" class="idn">
                        <input type="hidden" name="status" class="mstatus">
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

<script type="text/javascript">
    function fkonfirmasi(id,status,info){
        $('.idn').val(id);
        $('.mstatus').val(status);
        $('.minfo').text(info);
    }

</script>