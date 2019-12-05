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

<div class="wrapper wrapper-content animated fadeInRight ecommerce">

	<div class="row">
		<div class="col-lg-12">
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Product info</a></li>
				</ul>
				<div class="tab-content">
					<div id="tab-1" class="tab-pane active">
						<div class="panel-body">
							<form action="<?= base_url() ?>index.php/backend/produk/add" method="POST" accept-charset="utf-8" enctype="multipart/form-data">

								<fieldset>
									<?php echo $this->session->flashdata('msg');?>
									<div class="form-group row"><label class="col-sm-2 col-form-label">Cover Produk:</label>
										<div class="col-sm-10">
											<div class="custom-file">
												<input id="logo" type="file" name="filefoto" required="" class="custom-file-input"  accept=".jpg,.jpeg,.png">
												<label for="logo" class="custom-file-label">Choose file...</label>
											</div> 
										</div>
									</div>
									<div class="form-group row"><label class="col-sm-2 col-form-label">Nama Produk:</label>
										<div class="col-sm-10"><input type="text" name="nama" class="form-control" ></div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Kategori:</label>
										<div class="col-sm-10">
											<select class="select2_demo_1 form-control" name="kategori">
												<option value="songket">Songket</option>
												<option value="pisau">Pisau</option>
											</select>
										</div>
									</div>
									<div class="form-group row"><label class="col-sm-2 col-form-label">Warna:</label>
										<div class="col-sm-10"><input type="text" name="warna" class="form-control" ></div>
									</div>
									<div class="form-group row"><label class="col-sm-2 col-form-label">Bahan:</label>
										<div class="col-sm-10"><input type="text" name="bahan" class="form-control" ></div>
									</div>
									<div class="form-group row"><label class="col-sm-2 col-form-label">Ukuran:</label>
										<div class="col-sm-10"><input type="text" name="ukuran" class="form-control" ></div>
									</div>
									<div class="form-group row"><label class="col-sm-2 col-form-label">Deskripsi:</label>
										<div class="col-sm-10">
											<textarea class="summernote" name="isi" ></textarea>
										</div>
									</div>



									<div class="form-group row">
										<div class="col-sm-12 text-right">
											<button type="submit" class="btn btn-primary">Save</button>
										</div>
									</div>

								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
