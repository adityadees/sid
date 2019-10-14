<!-- <style type="text/css">
	@charset "UTF-8";

	* {
		font-family: rounded, sans-serif;
	}

	html {
		background: #223;
	}

	.plx-card {
		transition: all 600ms ease;
		max-width: 1100px;
		display: flex;
		position: relative;
		overflow: hidden;
		margin: 30px 0;
		filter: drop-shadow(0 2px 1rem #112);
		border-radius: 4px;
	}

	.plx-card.bronze {
		overflow: visible;
	}

	@media screen and (max-width: 1000px) and (min-width: 700px) {
		.plx-card.bronze {
			left: 120px;
		}
	}

	@media screen and (min-width: 700px) {
		.plx-card.gold {
			height: 280px;
		}

		.plx-card.silver {
			height: 150px;
			border-radius: 2px;
		}

		.plx-card.bronze {
			height: 134px;
			width: 480px;
			display: inline-flex;
			margin: 30px 30px;
		}
	}

	@media screen and (max-width: 700px) {
		.plx-card {
			height: auto;
			width: auto;
			flex-direction: column;
			border-radius: 2px;
			margin: 25px 15px;
		}

		.plx-card.silver {
			height: 270px;
		}

		.plx-card.silver .flags {
			margin: 0 10px;
		}

		.plx-card.silver .links {
			text-align: right;
			justify-content: flex-end;
		}

		.plx-card.silver .links a {
			font-size: 24px;
			height: 30px;
			margin: -8px 5px 5px 5px;
			padding: 6px 0px 1px 0;
			border-radius: 2px;
			color: #FFFA;
			background: #8855DD;
		}

		.plx-card.silver .links a:hover {
			color: #FFF;
		}
	}

	.pxc-avatar {
		transition: all 600ms ease;
		display: flex;
		flex-direction: column;
		height: auto;
		width: 150px;
		justify-content: space-around;
	}

	.bronze .pxc-avatar img {
		width: 90px;
		height: 90px;
		top: -15px;
		left: -20px;
		position: absolute;
	}

	@media screen and (max-width: 700px) {
		.pxc-avatar {
			width: 100%;
			height: 100px;
			justify-content: space-around;
			align-items: center;
		}

		.silver .pxc-avatar img {
			position: absolute;
			width: 100px;
			height: 100px;
			top: -80px;
			right: 20px;
		}

		.bronze .pxc-avatar {
			height: 150px;
		}

		.bronze .pxc-avatar img {
			top: -105px;
			left: -10px;
			height: 80px;
			width: 80px;
		}
	}

	.pxc-avatar img {
		transition: all 600ms ease;
		width: 150px;
		height: 150px;
		border-radius: 100%;
		box-shadow: 0 1px 1rem rgba(10, 10, 25, 0.5);
		position: relative;
		z-index: 1;
	}

	@media screen and (max-width: 900px) {
		.pxc-avatar img {
			width: 125px;
			height: 125px;
		}
	}

	@media screen and (max-width: 700px) {
		.pxc-avatar img {
			margin-top: 100px;
		}
	}

	.pxc-bg {
		transition: all 600ms ease;
		border-radius: 2px;
		height: 100%;
		width: calc(100% - 75px);
		position: absolute;
		z-index: 0;
		pointer-events: none;
		left: 75px;
		background-size: cover;
		background-position: right;
		background-color: #2b2b95;
	}

	.silver .pxc-bg {
		height: 100%;
		background-size: contain;
	}

	@media screen and (max-width: 700px) {
		.silver .pxc-bg {
			height: 60%;
			top: 30px;
		}
	}

	.bronze .pxc-bg {
		background-size: cover;
		position: absolute;
		top: 0;
		left: 0;
		width: 480px;
		height: 100%;
		max-height: 80px;
		border-radius: 0;
		background-position: 0 -10px;
	}

	@media screen and (max-width: 900px) {
		.pxc-bg {
			left: 50px;
		}
	}

	@media screen and (max-width: 700px) {
		.pxc-bg {
			left: 0;
			top: 0;
			height: 200px;
			width: 100%;
			border-radius: 0;
		}

		.silver .pxc-bg {
			background-position: top right;
		}
	}

	.pxc-subcard {
		transition: all 600ms ease;
		border-radius: 3px;
		background: #1D1D2B;
		width: 650px;
		margin: 25px 200px 25px -25px;
		z-index: 0;
		padding: 15px 25px 15px 40px;
		position: relative;
		display: flex;
		flex-direction: column;
		box-shadow: 0 1px 1rem rgba(10, 10, 25, 0.3);
	}

	@media screen and (min-width: 700px) {
		.silver .pxc-subcard {
			margin: 0 0 0 -75px;
			padding: 15px 25px 15px 90px;
		}
	}

	@media screen and (max-width: 700px) {
		.silver .pxc-subcard {
			padding: 15px;
			margin: 5px;
			flex: 0 1 auto;
		}
	}

	.bronze .pxc-subcard {
		position: absolute;
		bottom: 0;
		margin: 0;
		padding: 15px 10px 10px 70px;
		width: 400px;
		height: auto;
		max-height: 80px;
		border-radius: 0;
	}

	@media screen and (max-width: 900px) {
		.pxc-subcard {
			margin-right: 120px;
			margin-left: -32px;
		}
	}

	@media screen and (max-width: 700px) {
		.pxc-subcard {
			margin: 25px 15px 30px 15px;
			padding: 60px 25px 20px;
			width: auto;
			height: auto;
			flex: 1 0 auto;
		}

		.silver .pxc-subcard {
			padding-top: 20px;
		}
	}

	.pxc-stopper {
		transition: all 600ms ease;
		height: 100%;
		width: calc(60%);
		background: #FFF8;
		display: block;
		position: absolute;
		z-index: 0;
		left: 75px;
	}

	.bronze .pxc-stopper {
		display: none;
	}

	@media screen and (max-width: 900px) {
		.pxc-stopper {
			left: 50px;
		}
	}

	@media screen and (max-width: 700px) {
		.pxc-stopper {
			left: 0;
			width: 100%;
			top: 200px;
			height: calc(100% - 200px);
			background: white;
			border-radius: 0;
		}

		.silver .pxc-stopper {
			height: 50%;
			bottom: 0;
			top: initial;
		}
	}

	.pxc-tags {
		position: absolute;
		bottom: -15px;
		right: 10px;
		height: 32px;
		overflow: hidden;
		text-align: right;
	}

	.silver .pxc-tags,
	.bronze .pxc-tags {
		display: none;
	}

	.pxc-tags div {
		color: white;
		display: inline-block;
		background: #8855DD;
		border-radius: 12px;
		padding: 2px 10px;
		line-height: 1.7;
		margin: 4px 4px;
		font-size: 12px;
		height: 20px;
	}

	@media screen and (max-width: 700px) {
		.pxc-tags {
			height: 64px;
			text-align: center;
			position: relative;
			width: 100%;
			bottom: 0;
			left: 0;
			margin-bottom: 10px;
		}

		.pxc-tags div {
			color: #8855DD;
			border: solid 1px #8855DD;
			background: transparent;
		}
	}

	.pxc-title {
		font-size: 24px;
		margin-bottom: 4px;
		color: white;
		width: calc(100% - 50px);
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
		flex: 0 0 auto;
	}

	.bronze .pxc-title {
		font-size: 18px;
	}

	@media screen and (max-width: 700px) {
		.pxc-title {
			font-size: 16px;
			white-space: initial;
			overflow: initial;
			text-overflow: initial;
		}
	}

	.pxc-sub {
		font-size: 14px;
		margin: 2px 0 8px 0;
		flex: 1 1 auto;
		overflow: hidden;
		-webkit-mask-image: linear-gradient(black 80%, transparent 100%);
		color: #a6aad1;
	}

	.silver .pxc-sub {
		overflow: visible;
	}

	@media screen and (max-width: 700px) {
		.pxc-sub {
			font-size: 13px;
		}
	}

	.pxc-feats {
		font-size: 13px;
		color: #5f5f80;
		flex: 1 1 auto;
		padding-bottom: 5px;
		margin-bottom: 5px;
		line-height: 1.3;
		overflow: hidden;
		-webkit-mask-image: linear-gradient(black 50%, transparent 100%);
	}

	.silver .pxc-feats,
	.bronze .pxc-feats {
		display: none;
	}

	@media screen and (max-width: 700px) {
		.pxc-feats {
			font-size: 12px;
			margin-top: 10px;
			text-align: center;
		}
	}

	.pxc-feats span:not(:first-child):before {
		content: " • ";
		margin: 3px;
	}

	.bottom-row {
		flex: 0 1 auto;
		margin-top: 10px;
		display: flex;
		justify-items: space-around;
		align-items: center;
	}

	@media screen and (max-width: 700px) {
		.bottom-row {
			border-top: solid 1px rgba(255, 255, 255, 0.05);
			padding-top: 5px;
		}
	}

	.bottom-row .pxc-info {
		display: flex;
		align-items: center;
		justify-content: space-between;
	}

	.bronze .bottom-row .pxc-info {
		display: none;
	}

	@media screen and (max-width: 700px) {
		.bottom-row .pxc-info {
			position: absolute;
			bottom: -28px;
			left: -10px;
			justify-content: space-between;
			width: 100%;
		}

		.bottom-row .pxc-info .region {
			color: #112;
			font-size: 13px;
			text-transform: uppercase;
		}
	}

	.bottom-row .links {
		display: flex;
		align-content: flex-end;
		flex: 1 0 auto;
		justify-content: flex-end;
	}

	.bottom-row .links a {
		color: #99D;
		font-size: 28px;
		text-align: center;
		width: 48px;
		height: 48px;
		display: inline-block;
		margin: 0 10px;
		cursor: pointer;
	}

	.bronze .bottom-row .links a {
		display: none;
	}

	.bottom-row .links a:hover {
		color: #EEF;
	}

	@media screen and (max-width: 700px) {
		.bottom-row .links {
			justify-content: center;
			margin-top: 10px;
			margin-bottom: -10px;
		}

		.bottom-row .links a {
			color: #a6aad1;
		}
	}

	.bottom-row .flags {
		overflow: hidden;
		height: 23px;
	}

	.bottom-row .flags span {
		margin: 2px 6px;
		background: white;
		border-radius: 3px;
		width: 24px;
		height: 16px;
		display: inline-block;
	}

	.bottom-row .region {
		color: white;
		margin-left: 8px;
	}

	.bronze .discordLink {
		display: flex !important;
		position: absolute;
		left: -5px;
		bottom: 5px;
		justify-content: space-around;
		align-items: center;
	}
</style>

<body onload="window.print()">
	<div class="plx-card gold" style="">
		<div class="pxc-bg" style="background-image:url('<?= base_url('assets/images/asrama/rusunawa.jpg')?>');"> </div>
		<div class="pxc-avatar"><img src="<?= base_url().'uploads/user/'.$alldata['foto']; ?>" /></div>
		<div class="pxc-stopper">
		</div>
		<div class="pxc-subcard">
			<div class="pxc-title"><?= ucwords($alldata['nama']); ?></div>
			<div class="pxc-sub"> <?= ucwords($alldata['kpm']); ?></div>
			<div class="pxc-feats">
				<span><?= ucwords($alldata['fakultas']); ?></span>
				<span><?= ucwords($alldata['jurusan']); ?></span>
				<span><?= ucwords($alldata['asramaid']); ?></span>
				<br>
				<b style="color:white">UNIVERSITAS SRIWIJAYA</b>
			</div>
		</div>
	</div>
</body>
-->


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Kartu Penghuni</title>

	<!-- Normalize or reset CSS with your favorite library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

	<!-- Load paper.css for happy printing -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

	<!-- Set page size here: A5, A4 or A3 -->
	<!-- Set also "landscape" if you need -->
	<style>@page { size: A4 landscape }</style>

	<!-- Custom styles for this document -->
	<link href='https://fonts.googleapis.com/css?family=Tangerine:700' rel='stylesheet' type='text/css'>
	<style>
		body   { font-family: serif }
		h1     { font-family: 'Tangerine', cursive; font-size: 40pt; line-height: 18mm}
		h2, h3 { font-family: 'Tangerine', cursive; font-size: 24pt; line-height: 7mm }
		h4     { font-size: 32pt; line-height: 14mm }
		h2 + p { font-size: 18pt; line-height: 7mm }
		h3 + p { font-size: 14pt; line-height: 7mm }
		li     { font-size: 11pt; line-height: 5mm }

		h1      { margin: 0 }
		h1 + ul { margin: 2mm 0 5mm }
		h2, h3  { margin: 2mm 3mm 3mm 0; float: left }
		h2 + p,
		h3 + p  { margin: 0 0 3mm 50mm }
		h4      { margin: 2mm 0 0 50mm; border-bottom: 2px solid black }
		h4 + ul { margin: 5mm 0 0 50mm }
		article { border: 4px double black; padding: 5mm 10mm; border-radius: 3mm }
	</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape" onload="window.print()">

	<!-- Each sheet element should have the class "sheet" -->
	<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
	<section class="sheet padding-20mm">

		<h1>Daftar Penghuni</h1>

		<?php 
		$jenis = '';
		$jenis_asrama = substr($alldata['asramaid'], 0,2);
		$lantai = substr($alldata['asramaid'], 2,1);
		$nomor = substr($alldata['asramaid'], 3,2);
		if($jenis_asrama == 'BA'){
			$jenis = 'Rusunawa Putra';
		} else if($jenis_asrama == 'BB'){
			$jenis = 'Rusunawa Putri';
		} else if($jenis_asrama == 'BC'){
			$jenis = 'Rusunawa Baru Putri';
		} else if($jenis_asrama == 'AA') {
			$jenis = 'Apartemen Putri';
		} else if($jenis_asrama == 'AB') {
			$jenis = 'Apartemen Putra';
		} else if($jenis_asrama == 'CA') {
			$jenis = 'Asrama Lahat Putri';
		} else if($jenis_asrama == 'CB') {
			$jenis = 'Asrama Muara Enim Putri';
		} else if($jenis_asrama == 'CC') {
			$jenis = 'Asrama MUBA Putri';
		} else if($jenis_asrama == 'CD') {
			$jenis = 'Asrama Musi Rawas Putra';
		} else if($jenis_asrama == 'CE') {
			$jenis = 'Asrama OKI Putri';
		} else if($jenis_asrama == 'CF') {
			$jenis = 'Asrama OKU Putra';
		} else if($jenis_asrama == 'CG') {
			$jenis = 'Asrama Palembang Putri';
		} else {
			$jenis = '';
		}
		?>
		<ul>
			<li><?= $jenis ?></li>
			<li><?= "Lantai : ".$lantai; ?></li>
			<li><?= "Nomor Kamar : ".$nomor ?></li>
		</ul>

		<article>
			<h2><img src="<?= base_url().'uploads/user/'.$alldata['foto']; ?>" style="width: 170px;height: 170px"></h2>
			<p><?= ucwords($alldata['nama']); ?></p>

			<h3></h3>
			<p><?= ucwords($alldata['kpm']); ?></p>

			<h4><?= ucwords($alldata['asramaid']); ?></h4>
			<ul>
				<li><div><b>Fakultas</b></div>
					
					<?php
					foreach ($fakultas_grab as $keyf) :
						if($keyf->fakultas_id == $alldata['fakultas']){
							echo $keyf->fakultas_nama;
						}
					endforeach;
					?>
				</li>
				<li><div><b>Jurusan</b></div>
					<?php
					foreach ($jurusan_grab as $keyf) :
						if($keyf->jurusan_id == $alldata['jurusan']){
							echo $keyf->jurusan_nama;
						}
					endforeach;
					?>
				</li>
				<li><div><b>Prodi</b></div>
					<?php
					foreach ($prodi_grab as $keyf) :
						if($keyf->prodi_id == $alldata['prodi']){
							echo $keyf->prodi_nama;
						}
					endforeach;
					?>
				</li>
			</ul>
		</article>

	</section>

</body>

</html>