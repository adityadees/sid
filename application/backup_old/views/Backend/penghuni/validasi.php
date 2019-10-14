<style type="text/css">
    .tdalign {
        vertical-align:middle !important;
    }
    
    .modal {
        overflow: auto !important;
    }
</style>

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
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>KPM</th>
                                    <th>Nama</th>
                                    <th>Faklutas</th>
                                    <th>Program Studi</th>
                                    <th>Tanggal Registrasi</th>
                                    <th>Foto</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0; 
                                foreach($registrasi_grab as $i) : $no++;
                                    ?>
                                    <tr class="gradeX" >
                                        <td class="tdalign text-center"><?= $no; ?></td>
                                        <td class="tdalign">
                                            <?= $i->penghuni_kpm?>
                                        </td>
                                        <td class="tdalign">
                                            <?= $i->penghuni_nama?>
                                        </td>
                                        <td class="tdalign">
                                            <?= $i->penghuni_fakultas?>
                                        </td>
                                        <td class="tdalign">
                                            <?= $i->penghuni_prodi?>
                                        </td>
                                        <td class="tdalign">
                                            <?= date('d-m-Y',strtotime($i->registrasi_tgl))?>
                                        </td>
                                        <td class="tdalign">
                                            <img src="<?= base_url('uploads/user/'.$i->penghuni_foto)?>" class="img-thumbnail img-md">
                                        </td>
                                        <td class="tdalign">
                                            <?php 
                                            if(date('Y-m-d') <= date('2019-08-03')){
                                                foreach ($pa_grab as $key => $value) :
                                                    if($i->registrasi_validasi=='no'){ 
                                                        if ($value['registrasi_id'] == $i->registrasi_id) { ?>
                                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modalKonfirmasi" onclick="fkonfirmasi('<?= $i->registrasi_id ?>','<?= $value["file_spp"] ?>', '<?= $value["file_struk"] ?>','<?= $i->registrasi_asrama ?>','<?= $i->penghuni_kpm?>','<?= $value['pa_id']; ?>')"><i class="fa fa-key"></i></button>
                                                            <?php
                                                        }  
                                                    } else { 
                                                        if ($value['registrasi_id'] == $i->registrasi_id) { ?>
                                                            <form action="<?= base_url('dash/v/surat-pengantar/'.$i->registrasi_id)?>" method="get" target="_blank">
                                                                <button type="submit" class="btn btn-primary"  title="Surat Pengantar">
                                                                    <i class="fa fa-print"></i>
                                                                </button>
                                                            </form>
                                                        <?php }   
                                                    }  
                                                endforeach; }  else {?>
                                                    <button class="btn btn-danger" title="Waktu validasi telah habis" disabled><i class="fa fa-key"></i></button>
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
        <div class="modal-dialog modal-lg">
            <form action="<?= base_url('backend/penghuni/konfirmasi')?>" method="POST">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Validasi Bukti Pembayaran</h4>
                    </div>


                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row" id="myDIV">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="i-checks">
                                                <label> <input type="checkbox" value="spp" name="checkfile" class="agreecbox"> <i></i> 
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="" id="file_spp" target="_blank">
                                                        <i class="fa fa-download"></i>  
                                                        Bukti Pembayaran SPP Terakhir
                                                    </a> 
                                                </label>
                                            </div>
                                            <div class="i-checks">
                                                <label> <input type="checkbox" value="struk" name="checkfile" class="agreecboxb"> <i></i> 
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="" id="file_struk" target="_blank">
                                                        <i class="fa fa-download"></i>  
                                                        Bukti Pembayaran Sewa Asrama
                                                    </a> 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="nextDiv" style="display: none">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="text-center">Pilih Kamar </h4>
                                                        <br>

                                                        <div class="portfolio-item-wrap" id="svgfile">

                                                            <object data="" type="image/svg+xml" id="alphasvg" width="100%" height="100%"></object>
                                                            <!-- <object data="<?= base_url('assets/svgrender/apartemen.svg')?>" type="image/svg+xml" id="alphasvg" width="100%" height="100%"></object> -->

                                                        </div>


                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Asrama</label>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="jenisgedung" class="form-control" id="apartemen_id" value="" readonly="">
                                                                <input type="text"  id="apartemen_text" class="form-control" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Tipe</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" id="jaxtipe" name="gdgtype">
                                                                    <!-- <option value="A">Apartemen Cowok</option>
                                                                        <option value="B">Apartemen Cewek</option> -->
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Lantai</label>
                                                                <div class="col-sm-9">
                                                                    <select id="lantaiid" class="form-control jaxlantai">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
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
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-b" style="display: none" id="btnBack">Back</button>
                            <button type="button" class="btn btn-b" id="btnNext">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="mdApart" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <form action="<?= base_url('backend/penghuni/konfirmasi')?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-label">Pilih kamar</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row team-members team-members-shadow m-b-40">

                                <input type="hidden" name="idn"  id="idn">
                                <input type="hidden" name="kpm"  id="kpm">
                                <input type="hidden" name="pa_id"  id="pa_id">
                                <div class="col-lg-12" id="newpend">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-b" type="button">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="<?= base_url()?>assets/backend/js/jquery-3.1.1.min.js"></script>

        <script type="text/javascript">
          $(document).ready(function() {

            let dataArr = <?= $ar; ?>;
            let gid; 
            var mySVG = document.getElementById("alphasvg");
            var svgDoc;
            mySVG.addEventListener("load",function() {

                svgDoc = mySVG.contentDocument.documentElement;

                var xd = svgDoc.getElementsByTagName("rect");
                var xy = svgDoc.getElementsByTagName("tspan");
                var lantai = xy.asrama_lantai;
                var tipe = xy.asrama_nama;

                var attrTipe = $('#svgfile object').attr('tipe');
                tipe.textContent = attrTipe ? attrTipe : 'RUSUNAWA LAMA PUTRA';
                var attrLantai = $('#svgfile object').attr('lantai');
                lantai.textContent = attrLantai ? attrLantai : '1';

                resetState(xd, dataArr, 'inisiasi');

            }, false);


            $('select').on('change',function(){
                var xd = svgDoc.getElementsByTagName("rect");
                var xy = svgDoc.getElementsByTagName("tspan");
                var lantai = xy.asrama_lantai;
                var tipe = xy.asrama_nama;
                resetState(xd, dataArr, 'reset');
                var gdgtyp = $("#jaxtipe").val();
                var lantaiid=$('#lantaiid').val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('backend/penghuni/ajaxapar');?>",
                    data: { gdgtyp: gdgtyp, lantaiid: lantaiid}, 
                    cache: false,
                    success: function(result) {
                        var jres = JSON.parse(result);
                        lantai.textContent = JSON.parse(result).lantaix;
                        tipe.textContent = JSON.parse(result).tipex;
                        dataArr = jres.alldata;

                        $('#svgfile object').attr('data', '<?= base_url()?>assets/svgrender/'+jres.svgfile);
                        $('#svgfile object').attr('tipe', jres.tipex);
                        $('#svgfile object').attr('lantai', jres.lantaix);

                        resetState(xd, dataArr, 'success_call');
                    }
                });
            });

            function resetState(p_arg1, p_arg2, type){
                xd = p_arg1;
                dataArr = p_arg2;
                for(i=0;i<xd.length;i++){
                    let get_a = xd[i].getAttribute('id');
                    let gid,
                    glantai,
                    gstatus_asrama,
                    gstatus_kamar,
                    gpenghuni_kpm,
                    gpa_tgl_masuk,
                    gpa_tgl_booking,
                    gpenghuni_nama,
                    gpenghuni_foto,
                    gpenghuni_prodi,
                    gpenghuni_fakultas,
                    gidval,
                    jgedung,
                    gstatus_txt,
                    jnkmar;

                    for (var a = 0; a < dataArr.length; a++) {
                        if (dataArr[a].idval == get_a) {
                            gid = dataArr[a].id;
                          //  jgedung = 'Rusunawa Putra';
                            jnkmar = gid.substring(3, 5);

                            glantai = dataArr[a].lantai;
                            gidval = dataArr[a].idval;
                            gstatus_asrama = dataArr[a].status_asrama;
                            gpenghuni_kpm = dataArr[a].penghuni_kpm;
                            gpenghuni_nama = dataArr[a].penghuni_nama;
                            gpenghuni_foto = dataArr[a].penghuni_foto;
                            gpenghuni_prodi = dataArr[a].penghuni_prodi;
                            gpenghuni_fakultas = dataArr[a].penghuni_fakultas;
                            gstatus_kamar = dataArr[a].status_kamar;
                            gstatus_txt = '-';

                            if(gid.substring(0, 2) == 'BA'){
                                jgedung = 'Rusunawa Putra';
                            } else if(gid.substring(0, 2) == 'BB'){
                                jgedung = 'Rusunawa Putri';
                            } else if(gid.substring(0, 2) == 'BC'){
                                jgedung = 'Rusunawa Baru Putri';
                            } else if(gid.substring(0,2) == 'AA') {
                                jgedung == 'Apartemen Putra';
                            } else if(gid.substring(0,2) == 'AB') {
                                jgedung == 'Apartemen Putri';
                            } else {
                                jgedung == '';
                            }
                            if(type == 'reset'){
                                xd[i].style.fill="#ffffff";
                                break;
                            } else {
                                if(gstatus_asrama=='rusak'){
                                    xd[i].style.fill="#4e4e4e";
                                    gstatus_txt = 'Sedang dalam Perbaikan';
                                } else if(gstatus_asrama=='isi'){
                                    gstatus_txt = '-';
                                    xd[i].style.fill="#d04c47";
                                } else if(gstatus_asrama=='tersedia'){
                                    xd[i].style.fill="#ffffff";
                                    gstatus_txt = 'Kosong';
                                }  else {
                                    xd[i].style.fill="#ffffff";
                                }
                            }


                            xd[i].addEventListener("click", function(e){
                              e.preventDefault();
                              $("#mdApart").modal();
                              if(gstatus_txt=='Kosong'){
                                $("#newpend" ).html(`

                                    <div class="form-group row">
                                    <div class="col-md-12 text-center">
                                    <h3>Apakah anda yakin ingin memilih kamar ini?</h3>
                                    <hr>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Lantai</label>
                                    <div class="col-md-8">
                                    <label class="col-form-label">`
                                    +jgedung+
                                    `</label>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Lantai</label>
                                    <div class="col-md-8">
                                    <label class="col-form-label">`
                                    +glantai+
                                    `</label>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Nomor Kamar</label>
                                    <div class="col-md-8">
                                    <label class="col-form-label">`
                                    +jnkmar+
                                    `</label>
                                    </div>
                                    </div>


                                    <div class="form-group row">
                                    <div class="col-md-12 text-center">
                                    <button class="btn btn-primary">Ya! Setuju</button>
                                    <input type="hidden" name="asramaid" value="`+gid+`">
                                    </div>
                                    </div>
                                    `);
                            } else {
                                $("#newpend" ).html(`
                                    <div class="form-group row">
                                    <div class="col-md-12 text-center">
                                    <h3 class="text-danger">Maaf !! Untuk saat ini kamar tidak tersedia, Silahkan pilih kamar yang lain, terimakasih.</h3>
                                    </div>
                                    </div>
                                    `);
                            }
                        });
                        }
                    }
                    xd[i].addEventListener("mouseover", function(callback){
                        callback.target.style.opacity="0.5"
                    });

                    xd[i].addEventListener("mouseleave", function(callback){
                        callback.target.style.opacity="1"
                    });

                }
            }

        });
    </script>
    <script type="text/javascript">

        function fkonfirmasi(id,imgz,imgb,regasrama,kpm,pa_id){
            var x,y,z ;
            if(regasrama=='apartemen'){
                y = 'A';
                z = 'Apartemen';
                $('#svgfile object').attr('data', '<?= base_url()?>assets/svgrender/apartemen.svg');

                var selectValues = {
                  "AA": "Apartemen Pria",
                  "AB": "Apartemen Putri",
              };

              var $mySelect = $('#jaxtipe');
              $mySelect.empty(); 
              $.each(selectValues, function(key, value) {
                  var $option = $("<option/>", {
                    value: key,
                    text: value
                });
                  $mySelect.append($option);
              });


          } else if(regasrama=='rusunawa') {
            y = 'B';
            z = 'Rusunawa';
            $('#svgfile object').attr('data', '<?= base_url()?>assets/svgrender/rusunawa_lama_1.svg');

            var selectValues = {
                "BA": "Rusunawa Putra",
                "BB": "Rusunawa Putri",
                /*"BC": "Rusunawa Baru Putri"*/
            };

            var $mySelect = $('#jaxtipe');
            $mySelect.empty(); 
            $.each(selectValues, function(key, value) {
              var $option = $("<option/>", {
                value: key,
                text: value
            });
              $mySelect.append($option);
          });

        } else {}
        x = '<?= base_url("uploads/asrama/")?>'+regasrama+'/'+kpm+'/';
        $('#pa_id').val(pa_id);
        $('#idn').val(id);
        $('#kpm').val(kpm);
        $("#file_spp").attr("href", x+imgz);
        $("#file_struk").attr("href", x+imgb);
        $("#apartemen_text").val(z);
        $("#apartemen_id").val(y);

    }



    $('#btnNext').on('click', function() {
        let check_elem = $('.agreecbox');
        let check_elemb = $('.agreecboxb');
        if(check_elem.prop("checked") && check_elemb.prop("checked")){
            $('#nextDiv').show();
            $('#myDIV').hide();
            $("#btnBack").show();
            $("#btnNext").hide()
        } else {
            $("#agreebox").addClass('text-danger');
            $('#infoAlert').show();
        }
    });
    $('#btnBack').on('click', function() {
        $('#myDIV').show();
        $('#nextDiv').hide();
        $("#btnBack").hide();
        $("#btnNext").show()
        $("#agreebox").removeClass('text-danger');
        $('#infoAlert').hide();
    });
</script>
