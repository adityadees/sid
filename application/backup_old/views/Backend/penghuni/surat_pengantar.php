<title><?= $title ?></title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<style type="text/css">
	.wrapper {
		display:table;
		width:700px;
		height: auto;
	}
	#row {
		display:table-row;
	}
	#first {
		display:table-cell;
		background-color:red;
		width:100px;
	}
	#second {
		display:table-cell;
		background-color:blue;
		width:300px;
		text-align: center;
	}
	#third {
		display:table-cell;
		background-color:#bada55;
		width:100px;
		text-align: right;
	}

	.side1 {
		display:table-cell;
		background-color:red;
		width:100px;
	}
	.side2 {
		display:table-cell;
		background-color:blue;
		width:300px;
		text-align: center;
	}
	.side3 {
		display:table-cell;
		background-color:#bada55;
		width:100px;
		text-align: right;
	}

	body {
		font-family: 'Roboto', sans-serif;
		font-size: 0.85em;
		padding-left: 30px;
		padding-right: 30px;
		line-height: 1em;
	}
	@font-face {
		font-family: 'Roboto', sans-serif;
		font-style: normal;
		font-weight: normal;
	}  

</style>


<body>
	<div class="wrapper">
		<table width="100%">
			<tr>
				<td width="20%" style="vertical-align:middle;text-align: center;">
					<img src="<?= $_SERVER["DOCUMENT_ROOT"].'/bpu/assets/images/logo/logo-unsri.png' ?>" style="max-width:150px;max-height: 100px;">
				</td>
				<td width="70%" style="vertical-align:middle;">
					<h3 style="text-align:center;font-weight: bold;font-size: 16px;padding-left: -20px;">	
						KEMENTERIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI<br>
					UNIVERSITAS SRIWIJAYA</h3>
				</p>
				<p style="text-align:center">		
					Jalan Palembang – Prbumulih , KM 32 Inderalaya Kabupaten Ogan Ilir (30662)<br>
					Telepon (0711) 580069 , 580225, 580169 Faksimile (0711) 580644<br>
					Laman : www. Unsri.ac.id
				</p>
			</td>
		</tr>
	</table>
</div>

<div style="padding-left: 25px;padding-right: 25px;font-size: 15px">
	<hr>
	<div class="wrapper">
		<table width="100%" style="font-weight: bold;">
			<tr>
				<td width="100%" style="vertical-align:middle;">
					<h3 style="text-align:center">		
						SURAT PENGANTAR<br>
						PENGHUNI APARTEMEN/RUSUNAWA/ASRAMA
					</h3>
				</td>
			</tr>
		</table>
	</div>


	<div class="wrapper">
		<table width="100%">
			<tr>
				<td width="100%" style="vertical-align:middle;text-align: justify;">
					<p>		
						Kepada<br>
						Yth. Kepala Apartemen/Rusunawa/Asrama Mahasiswa<br>
						Di Inderalaya
					</p>
				</td>
			</tr>
		</table>
	</div>


	<div class="wrapper">
		<table width="100%">
			<tr>
				<td width="100%" style="vertical-align:middle;">
					<p>		
						Berdasarkan hasil validasi terhadap calon penghuni Apartemen/Rusunawa/Asrama Mahasiswa oleh pengurus Apartemen/Rusunawa/Asrama Mahasiswa menyatakan bahwa:
					</p>
				</td>
			</tr>
		</table>
	</div>

	<div class="wrapper">
		<table width="100%">
			<tr>
				<td width="150px" style="text-align: left;">
					Nama
				</td>
				<td width="10px" style="text-align: left;">
					:
				</td>
				<td width="540px" style="text-align: left;">
					<?= $user_info[0]->penghuni_nama ?>
				</td>
			</tr>
			<tr>
				<td width="150px" style="text-align: left;">
					NIM
				</td>
				<td width="10px" style="text-align: left;">
					:
				</td>
				<td width="540px" style="text-align: left;">
					<?= $user_info[0]->penghuni_kpm ?>
				</td>
			</tr>
			<tr>
				<td width="150px" style="text-align: left;">
					Fakultas
				</td>
				<td width="10px" style="text-align: left;">
					:
				</td>
				<td width="540px" style="text-align: left;">
					<?= $user_info[0]->penghuni_fakultas ?>
				</td>
			</tr>
			<tr>
				<td width="150px" style="text-align: left;">
					Jurusan
				</td>
				<td width="10px" style="text-align: left;">
					:
				</td>
				<td width="540px" style="text-align: left;">
					<?= $user_info[0]->penghuni_jurusan ?>
				</td>
			</tr>
			<tr>
				<td width="150px" style="text-align: left;">
					Program Studi
				</td>
				<td width="10px" style="text-align: left;">
					:
				</td>
				<td width="540px" style="text-align: left;">
					<?= $user_info[0]->penghuni_prodi ?>
				</td>
			</tr>
			<tr>
				<td width="150px" style="text-align: left;">
					Jenis Pemondokan
				</td>
				<td width="10px" style="text-align: left;">
					:
				</td>
				<td width="540px" style="text-align: left;">
					<?php
					if($user_info[0]->registrasi_asrama == 'rusunawa'){
						echo "<strike>Apartemen</strike>/Rusunawa/<strike>Asrama Mahasiswa</strike>*";
					} else if($user_info[0]->registrasi_asrama == 'apartemen'){
						echo "Apartemen/<strike>Rusunawa</strike>/<strike>Asrama Mahasiswa</strike>*";
					} else {
						echo "<strike>Apartemen</strike>/<strike>Rusunawa</strike>/Asrama Mahasiswa*";
					}
					?>
				</td>
			</tr>
			<tr>
				<td width="150px" style="text-align: left;">
					Kamar Nomor
				</td>
				<td width="10px" style="text-align: left;">
					:
				</td>
				<td width="540px" style="text-align: left;">
					<?= $user_info[0]->asrama_id ?>
				</td>
			</tr>
		</table>
	</div>



	<div class="wrapper">
		<table width="100%">
			<tr>
				<td width="100%" style="vertical-align:middle;text-align: justify;">
					<p>		
						Untuk difasilitasi yang bersangkutan mendapatkan pemondokan tersebut.<br>
						Atas Kerja samanya saya ucapkan terimakasih.
					</p>
				</td>
			</tr>
		</table>
	</div>

	<div class="wrapper">
		<table width="100%">
			<tr>
				<td width="40%">&nbsp;</td>
				<td width="20%">
					&nbsp;
				</td>
				<td width="40%">
					Inderalaya, <?= date('d/m/Y'); ?>
				</td>
			</tr>
			<tr>
				<td width="40%">
					Mengetahui
					<br>
					Manajer Aset,
				</td>
				<td width="20%">
					&nbsp;
				</td>
				<td width="40%" style="vertical-align: top">
					Supervisor, 
				</td>
			</tr>
			<tr>
				<td width="40%">
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					......................................
				</td>
				<td width="20%">
					&nbsp;
				</td>
				<td width="40%">
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					.................................................
				</td>
			</tr>
			<tr>
				<td width="40%">
					•	Coret yang tidak perlu.
				</td>
				<td width="20%">
					&nbsp;
				</td>
				<td width="40%">
				</td>
			</tr>
		</table>
	</div>


</div>
</body>
