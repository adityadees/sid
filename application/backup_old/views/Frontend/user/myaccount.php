<div></div>
<section id="page-title"  class="background-overlay-dark" data-parallax-image="<?= base_url('assets/images/bg/banner.jpg')?>">
    <div class="container">
        <div class="page-title">
            <h1><?= $title; ?></h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="<?= base_url()?>" title="Home">Home</a></li>
                <li class="active"><a href="#"><?= $title; ?></a></li>
            </ul>
        </div>
    </div>
</section>
<section id="content">
    <div class="container"> 
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <?php echo $this->session->flashdata('msg');?>
                <div class="tabs ">
                    <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard2" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="dashboard2" role="tabpanel" aria-labelledby="dashboard-tab">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info">Untuk melakukan perubahan infomasi akademik silahkan langsung menghubungi admin BPU</div>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-success text-white"><a href="<?= base_url('uploads/attach/surat_pernyataan.pdf'); ?>" target="_blank"><i class="fa fa-download"></i>&nbsp;&nbsp;Download Surat Pernyataan</a></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="call-to-action call-to-action-border">
                                                <h3>Informasi Akademik</h3>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        NIM
                                                    </div>
                                                    <div class="col-md-8">
                                                        <?= $data_user->penghuni_kpm ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        Fakultas
                                                    </div>
                                                    <div class="col-md-8">
                                                        <?= $data_user->penghuni_fakultas ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        Jurusan
                                                    </div>
                                                    <div class="col-md-8">
                                                        <?= $data_user->penghuni_jurusan ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        Prodi
                                                    </div>
                                                    <div class="col-md-8">
                                                        <?= $data_user->penghuni_prodi ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="call-to-action call-to-action-border">
                                                <h3>Informasi Sewa</h3>

                                                <?php
                                                if(isset($data_registrasi[0])){
                                                    ?>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            Kode Asrama
                                                        </div>
                                                        <div class="col-md-8">
                                                            <?= $data_registrasi[0]->asrama_id ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            Tipe
                                                        </div>
                                                        <div class="col-md-8">
                                                            <?php
                                                            if(substr($data_registrasi[0]->asrama_id, 0,2) == 'AA'){
                                                                echo "Apartemen A";
                                                            } else  if(substr($data_registrasi[0]->asrama_id, 0,2) == 'AB'){
                                                                echo "Apartemen B";
                                                            } else  if(substr($data_registrasi[0]->asrama_id, 0,2) == 'BA'){
                                                                echo "Rusunawa Putra";
                                                            } else  if(substr($data_registrasi[0]->asrama_id, 0,2) == 'BB'){
                                                                echo "Rusunawa Lama Putri";
                                                            } else  if(substr($data_registrasi[0]->asrama_id, 0,2) == 'BC'){
                                                                echo "Rusunawa Baru Putri";
                                                            } else {
                                                                echo "Anda belum memiliki kamar";
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            Lantai
                                                        </div>
                                                        <div class="col-md-8">
                                                            <?= substr($data_registrasi[0]->asrama_id, 2,1); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            Nomor
                                                        </div>
                                                        <div class="col-md-8">
                                                            <?= substr($data_registrasi[0]->asrama_id, 3,2); ?>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-danger">
                                                              Untuk saat ini anda belum memiliki kamar yang disewa, atau status anda masih dalam penangguhan dan masih menunggu untuk divalidasi.
                                                          </div>  
                                                      </div>
                                                  </div>

                                              <?php } ?>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>
                      <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="tabs tabs-vertical">
                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="nav flex-column nav-tabs" id="myTab4" role="tablist" aria-orientation="vertical">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal4" role="tab" aria-controls="personal" aria-selected="true">Data Pribadi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="paswrd-tab" data-toggle="tab" href="#paswrd4" role="tab" aria-controls="paswrd" aria-selected="false">Password</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="ortuwal-tab" data-toggle="tab" href="#ortuwal4" role="tab" aria-controls="ortuwal" aria-selected="false">Orang Tua / Wali</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content" id="myTabContent4">
                                        <div class="tab-pane fade show active" id="personal4" role="tabpanel" aria-labelledby="personal-tab">

                                            <form class="form-transparent-grey" action="<?= base_url('frontend/user/update');?>" method="POST" enctype="multipart/form-data"  id="personal-form">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <div class="heading-text heading-line">
                                                            <h5>Data Pribadi</h5>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 center p-20 background-white b-r-6">
                                                                <div class="row" style="margin-bottom: 120px">
                                                                    <div class="col-md-6 mx-auto">
                                                                        <div class="container">
                                                                            <div class="picture-container">
                                                                                <div class="picture">
                                                                                    <img src="<?= base_url('uploads/user/'.$data_user->penghuni_foto)?>" class="picture-src" id="wizardPicturePreview" title="">
                                                                                    <input type="file" id="wizard-picture" name="filefoto" class="form-control"
                                                                                    data-validation=" mime size"
                                                                                    data-validation-allowing="jpg, jpeg, png, gif"
                                                                                    data-validation-max-size="2M"
                                                                                    data-validation-error-msg-size="Foto tidak boleh lebih dari 2MB"
                                                                                    data-validation-error-msg-mime="Hanya diperbolehkan jpg, png, gif" accept=".jpg,.jpeg,.png" 
                                                                                    >
                                                                                </div>
                                                                                <h6 class="">Foto Anda</h6>
                                                                                <span class="text-danger">*png / jpg<br> *Maks size (2MB)</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6 form-group">
                                                                <label class="sr-only">NIM</label>
                                                                <input type="text" name="nim" placeholder="NIM" id="nimreg" value="<?= $data_user->penghuni_kpm ?>" class="form-control" data-validation="number" 
                                                                data-validation-error-msg="NIM tidak boleh kosong (Hanya Angka)" readonly="">
                                                            </div>

                                                            <div class="col-lg-6 form-group">
                                                                <label class="sr-only">Username</label>
                                                                <input type="text" name="username" value="<?= $data_user->user_username ?>" placeholder="Username" id="uname" class="form-control "  data-validation="length alphanumeric" 
                                                                data-validation-length="3-20"  data-validation-error-msg="Username harus angka atau huruf dan (3-20 karakter)"  readonly="">
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6 form-group">
                                                                <label class="sr-only">Nama</label>
                                                                <input type="text" name="nama" placeholder="Nama" id="nama" class="form-control" value="<?= $data_user->penghuni_nama ?>" data-validation="custom" 
                                                                data-validation-regexp="[a-zA-Z][a-zA-Z ]+" data-validation-error-msg="Nama tidak boleh kosong">
                                                            </div>

                                                            <div class="col-lg-6 form-group">
                                                                <label class="sr-only">Email</label>
                                                                <input type="email" name="email" placeholder="Email" id="email" value="<?= $data_user->penghuni_email ?>" class="form-control" data-validation="email" data-validation-error-msg="Email tidak boleh kosong">
                                                            </div>
                                                        </div>
                                                        <div class="row">


                                                            <div class="col-lg-6 form-group">
                                                                <label class="sr-only">Telepon</label>
                                                                <input type="tel" name="telepon" placeholder="Telepon" id="tel" value="<?= $data_user->penghuni_tel ?>" class="form-control" data-validation=" number" 
                                                                data-validation-length="min6" data-validation-error-msg="Telepon tidak boleh kosong (Hanya angka)">
                                                            </div>


                                                            <div class="col-lg-6 form-group">
                                                                <select class="form-control" name="jk" id="selJK"  data-validation="required" data-validation-error-msg="Silahkan pilih jenis kelamin anda">
                                                                    <option value="">- Jenis Kelamin -</option>
                                                                    <option value="L" <?php if($data_user->penghuni_jk=='L') {echo "selected";} else {} ?>>Laki - Laki</option>
                                                                    <option value="P" <?php if($data_user->penghuni_jk=='P') {echo "selected";} else {} ?>>Perempuan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-lg-12 form-group">
                                                                <label class="sr-only">Alamat</label>
                                                                <textarea class="form-control" placeholder="Alamat" id="alm" name="alamat" data-validation=" length" data-validation-length="min6"  data-validation-error-msg="Alamat tidak boleh kosong"><?= $data_user->penghuni_alamat ?></textarea>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-lg-12 text-right form-group">
                                                                <button class="btn" type="submit" name="update_personal" id="updatePersonal">Update Profil</button>
                                                                <button type="button" class="btn btn-danger m-l-10"  onclick="window.history.go(-1); return false;">Batal</button>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="tab-pane fade" id="paswrd4" role="tabpanel" aria-labelledby="paswrd-tab">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form method="POST" action="<?= base_url('frontend/user/update')?>">
                                                        <div class="heading-text heading-line">
                                                            <h5>Ganti Password</h5>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 form-group">
                                                                <label class="sr-only">Password Lama</label>
                                                                <input type="password" id="oldpassword" name="oldpassword" placeholder="Password Lama" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 form-group">
                                                                <label class="sr-only">Password Baru</label>
                                                                <input type="password" name="password" placeholder="Password Baru" class="form-control"  name="password" id="password" placeholder="Password" class="form-control" data-validation="strength" data-validation-strength="2" data-validation-error-msg="&nbsp;&nbsp;&nbsp;Password tidak cukup kuat">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 form-group">
                                                                <label class="sr-only">Repassword</label>
                                                                <input type="password" id="repassword" name="newpassword" placeholder="Repassword" class="form-control"  onChange="checkPasswordMatch();">
                                                            </div>
                                                            <div class="registrationFormAlert " id="divCheckPasswordMatch">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-12 text-right form-group">
                                                                <button class="btn" type="submit" name="update_password" id="updatePassword">Change Password</button>
                                                                <button type="button" class="btn btn-danger m-l-10"  onclick="window.history.go(-1); return false;">Batal</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="ortuwal4" role="tabpanel" aria-labelledby="ortuwal-tab">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form method="POST" action="<?= base_url('frontend/user/update')?>">

                                                        <div class="heading-text heading-line">
                                                            <h5>Data Orang Tua / Wali</h5>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-lg-6 form-group">
                                                                <label class="sr-only">Nama Orang Tua / Wali</label>
                                                                <input type="text" name="nama_ortu" placeholder="Nama Orang Tua / Wali" value="<?= $data_user->penghuni_nama_ortu ?>" class="form-control" id="ort"  data-validation="custom" 
                                                                data-validation-regexp="[a-zA-Z][a-zA-Z ]+" data-validation-error-msg="Nama tidak boleh kosong">
                                                            </div>
                                                            <div class="col-lg-6 form-group">
                                                                <label class="sr-only">No. Hp Orang Tua</label>
                                                                <input type="tel" name="tel_ortu" value="<?= $data_user->penghuni_tel_ortu ?>" id="telort" placeholder="No. Hp Orang Tua" class="form-control" data-validation=" number" 
                                                                data-validation-length="min6"  data-validation-error-msg="Telepon orang tua tidak boleh kosong">
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-lg-12 form-group">
                                                                <label class="sr-only">Alamat Orang Tua</label>
                                                                <textarea class="form-control" id="alort" placeholder="Alamat Orang Tua" name="alamat_ortu" data-validation=" length" data-validation-length="min6"  data-validation-error-msg="Alamat Orang tua tidak boleh kosong"><?= $data_user->penghuni_alamat_ortu ?></textarea>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-lg-12 text-right form-group">
                                                                <button class="btn" type="submit" name="update_ortu" id="updateOrtu">Update Data</button>
                                                                <button type="button" class="btn btn-danger m-l-10"  onclick="window.history.go(-1); return false;">Batal</button>
                                                            </div>
                                                        </div>
                                                    </form>
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
    </div>
</div>
</section>

