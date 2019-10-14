


<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-3">
			<div class="widget style1 blue-bg">
				<div class="row">
					<div class="col-4 text-center">
						<i class="fa fa-trophy fa-5x"></i>
					</div>
					<div class="col-8 text-right">
						<span> Unique Visitor </span>
						<h2 class="font-bold">2,500</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="widget style1 navy-bg">
				<div class="row">
					<div class="col-4">
						<i class="fa fa-hotel fa-5x"></i>
					</div>
					<div class="col-8 text-right">
						<span> Penghuni Aktif </span>
						<h2 class="font-bold">2,600</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="widget style1 lazur-bg">
				<div class="row">
					<div class="col-4">
						<i class="fa fa-user fa-5x"></i>
					</div>
					<div class="col-8 text-right">
						<span> Akun Terdaftar </span>
						<h2 class="font-bold"><?= number_format(count($count_user))?></h2>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="widget style1 yellow-bg">
				<div class="row">
					<div class="col-4">
						<i class="fa fa-newspaper-o fa-5x"></i>
					</div>
					<div class="col-8 text-right">
						<span> Postingan </span>
						<h2 class="font-bold"><?= number_format(count($count_artikel))?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row  border-bottom white-bg dashboard-header">
	<div class="col-md-8">
		<h2>Artikel Populer</h2>
		<ul class="list-group clear-list m-t">
			<?php 
			foreach($artikel_pop as $xc => $val) : 
				?>
				<li class="list-group-item <?php if(($xc+1) == '1'){ echo "fist-item";}?>">
					<span class="float-right"><?= number_format($val->artikel_views) ?></span>
					<span class="label label-success"><?= $xc+1;  ?></span> 
					<a href="<?= base_url('index.php/dash/artikel/detail/'.$val->artikel_id)?>" target="_blank"><?= $val->artikel_judul?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="col-md-4">
		<h2>Top Page Views</h2>
		<ul class="list-group clear-list m-t">
			<?php 
			foreach($hits_pop as $xc => $val) : 
				?>
				<li class="list-group-item <?php if(($xc+1) == '1'){ echo "fist-item";}?>">
					<span class="float-right"><?= number_format($val->hitcount) ?></span>
					<span class="label label-success"><?= $xc+1;  ?></span> 
					<?= $val->pageid?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<!-- 
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Statistik</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-4">
							<h5>Apartemen </h5>
							<div class="ibox-content">
								<div>
									<canvas id="apartemenChart" height="140"></canvas>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<h5>Rusunawa </h5>
							<div class="ibox-content">
								<div>
									<canvas id="rusunawaChart" height="140"></canvas>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<h5>Asrama Pemda </h5>
							<div class="ibox-content">
								<div>
									<canvas id="asramaChart" height="140"></canvas>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<h5>Total Persentase Jumlah Pemondokan Yang Terisi</h5>
							<div class="ibox-content">
								<div>
									<canvas id="barChart" height="140"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->
<script src="<?= base_url()?>assets/backend/js/jquery-3.1.1.min.js"></script>
<script src="<?= base_url()?>assets/backend/js/plugins/chartJs/Chart.min.js"></script>

<script type="text/javascript">
	$(function () {


		var barData = {
			labels: [
			<?php foreach($count_asrama as $k) :?>
				"<?= $k['jenis']?>",
			<?php endforeach; ?>
			],
			datasets: [

			{
				label: "Persentase",
				backgroundColor: 'rgba(26,179,148,0.5)',
				borderColor: "rgba(26,179,148,0.7)",
				pointBackgroundColor: "rgba(26,179,148,1)",
				pointBorderColor: "#fff",
				data: [
				<?php foreach($count_asrama as $k) :?>
					<?= $k['avg_total']."," ?>
				<?php endforeach; ?>
				]
			}

			]
		};

		var barOptions = {
			responsive: true,
		};


		var ctx2 = document.getElementById("barChart").getContext("2d");
		new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});


		var apartemenData = {
			labels: [
			<?php foreach($dt_apar as $k) :?>
				"<?= $k->status ?>",
			<?php endforeach; ?>
			],
			datasets: [{
				data: [
				<?php foreach($dt_apar as $k) :?>
					<?= $k->total."," ?>
				<?php endforeach; ?>
				],
				backgroundColor: ["#a3e1d4","#dedede","#b5b8cf"]
			}]
		} ;


		var apartemenOptions = {
			responsive: true
		};


		var ctx4 = document.getElementById("apartemenChart").getContext("2d");
		new Chart(ctx4, {type: 'doughnut', data: apartemenData, options:apartemenOptions});

		var rusunawaData = {
			labels: [
			<?php foreach($dt_rusun as $k) :?>
				"<?= $k->status ?>",
			<?php endforeach; ?>
			],
			datasets: [{
				data: [
				<?php foreach($dt_rusun as $k) :?>
					<?= $k->total."," ?>
				<?php endforeach; ?>
				],
				backgroundColor: ["#a3e1d4","#dedede","#b5b8cf"]
			}]
		} ;


		var rusunawaOptions = {
			responsive: true
		};


		var ctx4 = document.getElementById("rusunawaChart").getContext("2d");
		new Chart(ctx4, {type: 'doughnut', data: rusunawaData, options:rusunawaOptions});

		var asramaData = {
			labels: [
			<?php foreach($dt_asram as $k) :?>
				"<?= $k->status ?>",
			<?php endforeach; ?>
			],
			datasets: [{
				data: [
				<?php foreach($dt_asram as $k) :?>
					<?= $k->total."," ?>
				<?php endforeach; ?>
				],
				backgroundColor: ["#a3e1d4","#dedede","#b5b8cf"]
			}]
		} ;


		var asramaOptions = {
			responsive: true
		};


		var ctx4 = document.getElementById("asramaChart").getContext("2d");
		new Chart(ctx4, {type: 'doughnut', data: asramaData, options:asramaOptions});



	});
</script>