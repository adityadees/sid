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
                                    <th>Kode Asrama</th>
                                    <th>Nama</th>
                                    <th class="text-center">Tanggal Booking</th>
                                    <th class="text-center">Status Bayar</th>
                                    <th class="text-center">Status Validasi</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0; 
                                foreach($pa_grab as $i) : $no++;
                                    ?>
                                    <tr class="gradeX">
                                        <td>
                                            <?= $no;?>
                                        </td>
                                        <td>
                                            <?= $i->asrama_id ?>
                                        </td>
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#modalMhs" onclick="detailMhs('<?= $i->penghuni_kpm ?>','<?= $i->penghuni_nama ?>','<?= $i->penghuni_email ?>','<?= $i->penghuni_tel ?>','<?= $i->penghuni_alamat ?>','<?= $i->penghuni_fakultas ?>','<?= $i->penghuni_prodi ?>','<?= $i->penghuni_nama_ortu ?>','<?= $i->penghuni_tel_ortu ?>','<?= $i->penghuni_alamat_ortu ?>','<?= $i->penghuni_foto ?>')">
                                                <?= $i->penghuni_nama ?>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?= date('d-m-Y',strtotime($i->registrasi_tgl)) ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if($i->pa_status_bayar=='belum'){
                                                echo "<span class='badge badge-danger'>Belum Bayar</span>"; 
                                            } else {
                                                echo "<span class='badge badge-success'>Sudah Bayar</span>"; 
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if($i->registrasi_validasi=='no'){
                                                echo "<span class='badge badge-danger'>Invalid</span>"; 
                                            } else {
                                                echo "<span class='badge badge-success'>Valid</span>"; 
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if($i->pa_status_bayar=='belum'){ ?>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalKonfirmasi" onclick="fkonfirmasi('<?= $i->pa_id ?>','<?= $i->pa_filespp ?>')"><i class="fa fa-key"></i></button>
                                            <?php } else { ?>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalDetail" onclick="detail('<?= $i->asrama_id?>','<?= date('d-m-Y',strtotime($i->pa_tgl_masuk))?>','<?= $i->pa_status_mhs ?>')"><i class="fa fa-eye"></i></button>

                                            <?php } ?>
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


<div class="modal inmodal" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('backend/penghuni/konfirmasi')?>" method="POST">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title text-center">Konfirmasi</h4>
                    <small class="font-bold text-center">Konfirmasi penyewaan kamar</small>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apakah anda yakin ingin mengkonfirmasi kamar ini?</p>
                    <div class="form-group">
                        <img id="imgzd" class="form-control">
                        <input type="hidden" name="id" id="idn">
                        <input type="text" name="aggr" placeholder="Tulis 'Ya' Jika anda setuju tulis 'Tidak' jika anda menolaknya" class="form-control" required="">
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

<div class="modal inmodal" id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-center">Detail</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        Kode
                    </div>
                    <div class="col-md-9">
                        <span id="aid"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Asrama Tipe
                    </div>
                    <div class="col-md-9">
                        <span id="ntipe"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Blok
                    </div>
                    <div class="col-md-9">
                        <span id="nblok"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Lantai
                    </div>
                    <div class="col-md-9">
                        <span id="nlantai"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Nomor Kamar
                    </div>
                    <div class="col-md-9">
                        <span id="nnomor"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Nomor Kasur
                    </div>
                    <div class="col-md-9">
                        <span id="nbed"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Status Mahasiswa
                    </div>
                    <div class="col-md-9">
                        <span id="mahastat"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Tanggal Masuk
                    </div>
                    <div class="col-md-9">
                        <span id="tglmsk"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal inmodal" id="modalMhs" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInRight">
            <div class="row animated fadeInRight">
                <div class="col-md-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Profile Detail</h5>
                        </div>
                        <div>
                            <div class="ibox-content  border-left-right">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img alt="image" class="rounded-circle circle-border m-b-md" id="pfot" style="width: 180px;height: 180px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4><strong id="pnm"></strong></h4>
                                        <p id="pkpm"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <i class="fa fa-phone"></i>
                                        <p id="ptel"></p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <i class="fa fa-envelope"></i>
                                        <p id="pemail"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <p>Alamat</p>
                                        <p id="palmt"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <h3>Data Orang Tua</h3>

                                        <div class="row">
                                            <div class="col-md-4">
                                                Nama
                                            </div>
                                            <div class="col-md-8">
                                                <span id="pnmortu"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Telepon
                                            </div>
                                            <div class="col-md-8">
                                                <span id="ptelort"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Alamat
                                            </div>
                                            <div class="col-md-8">
                                                <span id="palort"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function detail(asrama_id,tgl_masuk,mahasiswa_status){
        var tipe, blok, lantai, nomor,bed;
        tipe = asrama_id.substring(0, 1);
        blok = asrama_id.substring(1, 2);
        lantai = asrama_id.substring(2, 3);
        nomor = asrama_id.substring(3, 5);
        bed = asrama_id.substring(5, 7);

        if(tipe == 'A') {
            tipe = 'Apartemen';
        } else if(tipe == 'B'){
            tipe = 'Rusunawa'
        } else {}

        $('#ntipe').text(tipe);
        $('#nblok').text(blok);
        $('#nlantai').text(lantai);
        $('#nnomor').text(nomor);
        $('#nbed').text(bed);
        $('#aid').text(asrama_id);
        $('#tglmsk').text(tgl_masuk);
        $('#mahastat').text(mahasiswa_status);
    }
    function detailMhs(pkpm,pnm,pemail,ptel,palmt,pfak,pprod,pnmortu,ptelort,palort,pfot){

        var x ;
        x = '<?= base_url("uploads/user/")?>';
        $('#pkpm').text(pkpm);
        $('#pnm').text(pnm);
        $('#pemail').text(pemail);
        $('#ptel').text(ptel);
        $('#palmt').text(palmt);
        $('#pfak').text(pfak);
        $('#pprod').text(pprod);
        $('#pnmortu').text(pnmortu);
        $('#ptelort').text(ptelort);
        $('#palort').text(palort);
        $("#pfot").attr("src", x+pfot);
    }

    function fkonfirmasi(id,imgz){
        var x ;
        x = '<?= base_url("uploads/asrama/")?>';
        $('#idn').val(id);
        $("#imgzd").attr("src", x+imgz);
    }
    
</script>