<div></div>
<section id="page-title"  class="background-overlay-dark" data-parallax-image="<?= base_url('assets/images/bg/banner.jpg')?>">
	<div class="container">
		<div class="page-title">
			<h1><?= $title ?></h1>
		</div>
		<div class="breadcrumb">
			<ul>
				<li><a href="<?= base_url(); ?>" title="Home">Home</a></li>
				<li class="active"><a href="#"><?= $title ?></a></li>
			</ul>
		</div>
	</div>
</section>

<section id="content">
	<div class="container container-fullscreen">
		<div class="text-middle">
			<div class="text-center m-b-250">
				<br>
			</div>
			<div class="row">
				<div class="col-lg-8 center p-20 background-white b-r-6">
					<form class="form-transparent-grey" action="<?= base_url('frontend/user/create');?>" method="POST" enctype="multipart/form-data"  id="registration-form">
						<div class="row">
							<div class="col-lg-12">
								<h3>Register New Account</h3>
								<p>Silahkan diisi sesuai dengan data diri anda.</p>
								<?php echo $this->session->flashdata('msg');?>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="heading-text heading-line">
									<h5>Data anda</h5>
								</div>

								<div class="row" style="margin-bottom: 120px">
									<div class="col-md-6 mx-auto">
										<div class="container">
											<div class="picture-container">
												<div class="picture">
													<img src="" class="picture-src" id="wizardPicturePreview" title="">
													<input type="file" id="wizard-picture" name="filefoto" class="form-control"
													data-validation="length mime size"
													data-validation-length="min1"
													data-validation-allowing="jpg, jpeg, png, gif"
													data-validation-max-size="2M"
													data-validation-error-msg-size="Foto tidak boleh lebih dari 2MB"
													data-validation-error-msg-mime="Hanya diperbolehkan jpg, png, gif"
													data-validation-error-msg-length="Foto tidak boleh kosong" accept=".jpg,.jpeg,.png" 
													>
												</div>
												<h6 class="">Foto Anda</h6>
												<span class="text-danger">*png / jpg<br> *Maks size (2MB)</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 form-group">
										<label class="sr-only">Username</label>
										<input type="text" name="username" placeholder="Username" id="uname" class="form-control "  data-validation="length alphanumeric" 
										data-validation-length="3-20"  data-validation-error-msg="Username harus angka atau huruf dan (3-20 karakter)">
									</div>

									<div class="col-lg-6 form-group">
										<div class="input-group ">
											<label class="sr-only">Password</label>
											<input type="password" name="password" id="password" placeholder="Password" class="form-control" data-validation="strength" data-validation-strength="2" data-validation-error-msg="Password tidak cukup kuat">
											<div class="input-group-append">
												<span class="input-group-text" id="showPassword" style="cursor: pointer;"><i class="fa fa-eye" id="eye"></i></span>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 form-group">
										<label class="sr-only">Nama</label>
										<input type="text" name="nama" placeholder="Nama" id="nama" class="form-control" data-validation="custom" 
										data-validation-regexp="[a-zA-Z][a-zA-Z ]+" data-validation-error-msg="Nama tidak boleh kosong">
									</div>

									<div class="col-lg-6 form-group">
										<label class="sr-only">Email</label>
										<input type="email" name="email" placeholder="Email" id="email" class="form-control" data-validation="email" data-validation-error-msg="Email tidak boleh kosong">
									</div>
								</div>
								<div class="row">


									<div class="col-lg-6 form-group">
										<label class="sr-only">Telepon</label>
										<input type="tel" name="telepon" placeholder="Telepon" id="tel" class="form-control" data-validation=" number" 
										data-validation-length="min6" data-validation-error-msg="Telepon tidak boleh kosong (Hanya angka)">
									</div>


									<div class="col-lg-6 form-group">
										<select class="form-control" name="jk" id="selJK"  data-validation="required" data-validation-error-msg="Silahkan pilih jenis kelamin anda">
											<option value="">- Jenis Kelamin -</option>
											<option value="L">Laki - Laki</option>
											<option value="P">Perempuan</option>
										</select>
									</div>
								</div>
								<div class="row">

									<div class="col-lg-12 form-group">
										<label class="sr-only">Alamat</label>
										<textarea class="form-control" placeholder="Alamat" id="alm" name="alamat"  data-validation=" length" data-validation-length="min6"  data-validation-error-msg="Alamat tidak boleh kosong"></textarea>
									</div>
								</div>


							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="heading-text heading-line">
									<h5>Akademik</h5>
								</div>

								<div class="row">

									<div class="col-lg-6 form-group">
										<label class="sr-only">NIM</label>
										<input type="text" name="nim" placeholder="NIM" id="nimreg" class="form-control" data-validation="number" 
										data-validation-error-msg="NIM tidak boleh kosong (Hanya Angka)">
									</div>

									<div class="col-lg-6 form-group">
										<label class="sr-only">Fakultas</label>
										<input type="text" name="fakultas" placeholder="Fakultas" id="fak" class="form-control" data-validation="length"
										data-validation-length="min2" data-validation-error-msg="Fakultas tidak boleh kosong">
									</div>
								</div>
								<div class="row">
									
									<div class="col-lg-6 form-group">
										<label class="sr-only">Jurusan</label>
										<input type="text" name="jurusan" placeholder="Jurusan" id="jur" class="form-control" data-validation="length"
										data-validation-length="min2" data-validation-error-msg="Jurusan tidak boleh kosong">
									</div>
									<div class="col-lg-6 form-group">
										<label class="sr-only">Program Studi</label>
										<input type="text" name="prodi" placeholder="Program Studi" id="prod" class="form-control" data-validation="length"
										data-validation-length="min2" data-validation-error-msg="Prodi tidak boleh kosong">
									</div>
								</div>
								<div class="row">
									
									<div class="col-lg-12 form-group">
										<label class="sr-only">Jenis Mahasiswa</label>
										<select class="form-control" name="jm" id="selJM"  data-validation="required" data-validation-error-msg="Silahkan pilih jenis mahasiswa">
											<option value="">- Jenis Mahasiswa -</option>
											<option value="bm">Bidik Misi</option>
											<option value="nonbm">Non - Bidik Misi</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12">
								
								<div class="heading-text heading-line">
									<h5>Data Orang Tua / Wali</h5>
								</div>

								<div class="row">

									<div class="col-lg-6 form-group">
										<label class="sr-only">Nama Orang Tua / Wali</label>
										<input type="text" name="nama_ortu" placeholder="Nama Orang Tua / Wali" class="form-control" id="ort"  data-validation="custom" 
										data-validation-regexp="[a-zA-Z][a-zA-Z ]+" data-validation-error-msg="Nama tidak boleh kosong">
									</div>
									<div class="col-lg-6 form-group">
										<label class="sr-only">No. Hp Orang Tua</label>
										<input type="tel" name="tel_ortu" id="telort" placeholder="No. Hp Orang Tua" class="form-control" data-validation=" number" 
										data-validation-length="min6"  data-validation-error-msg="Telepon orang tua tidak boleh kosong">
									</div>
								</div>
								<div class="row">

									<div class="col-lg-12 form-group">
										<label class="sr-only">Alamat Orang Tua</label>
										<textarea class="form-control" id="alort" placeholder="Alamat Orang Tua" name="alamat_ortu" data-validation=" length" data-validation-length="min6"  data-validation-error-msg="Alamat Orang tua tidak boleh kosong"></textarea>
									</div>
								</div>
							</div>
						</div>



						<div class="row">
							<div class="col-lg-12 text-right form-group">
								<button class="btn" type="submit" name="register" id="submitRegister">Registrasi</button>
								<button type="button" class="btn btn-danger m-l-10"  onclick="window.history.go(-1); return false;">Batal</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


