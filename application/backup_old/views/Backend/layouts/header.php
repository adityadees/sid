<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?></title>
	<meta name="keywords" content="Komputer Akuntansi - Universitas Sriwijaya" />
	<meta name="description" content="Komputer Akuntansi - Universitas Sriwijaya">
	<meta name="author" content="AdityaDS">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Favicon -->
	<link rel="icon" href="<?= base_url()?>assets/logo/logo-unsri.png" sizes="32x32" />
	<link rel="icon" href="<?= base_url()?>assets/logo/logo-unsri.png" sizes="192x192" />
	<link rel="apple-touch-icon-precomposed" href="<?= base_url()?>assets/logo/logo-unsri.png" />
	<meta name="msapplication-TileImage" content="<?= base_url()?>assets/logo/logo-unsri.png" />
	<link href="<?= base_url()?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/animate.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/style.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/summernote/summernote-bs4.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/backend/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/dropzone/basic.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/dropzone/dropzone.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/custom/fileinput.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/steps/jquery.steps.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/select2/select2.min.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/backend/css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
	<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.0/dist/leaflet.css" />
	<link rel="stylesheet" href="<?= base_url()?>assets/map/src/leaflet-search.css" />
	<link rel="stylesheet" href="<?= base_url()?>assets/map/style.css" /> -->
<!-- 	<link href="<?= base_url() ?>assets/map/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen"> -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/map/ubilabs/examples/styles.css')?>" />


	<style>
		.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
			margin: 0;
			padding: 0;
			border: none;
			box-shadow: none;
			text-align: center;
		}
		.kv-avatar {
			display: inline-block;
		}
		.kv-avatar .file-input {
			display: table-cell;
			width: 213px;
		}
		.kv-reqd {
			color: red;
			font-family: monospace;
			font-weight: normal;
		}
		.assa {
			max-height: 75px;
			max-width: : 75px;
		}

		@media screen and (min-width: 320px) {
			.assa {
				max-height: 100px;
				max-width: : 100px;
			}
		}
		@media screen and (min-width: 576px) {
			.assa {
				max-height: 100px;
				max-width: : 100px;
			}
		}

		// Medium devices (tablets, 768px and up)
		@media screen and (min-width: 768px) {
			.assa {
				max-height: 100px;
				max-width: : 100px;
			}
		}

		// Large devices (desktops, 992px and up)
		@media screen and (min-width: 992px) {
			.assa {
				max-height: 200px;
				max-width: : 200px;
			}
		}

		// Extra large devices (large desktops, 1200px and up)
		@media screen and (min-width: 1200px) {
			.assa {
				max-height: 250px;
				max-width: : 200px;
			}
		}
		@media screen and (min-width: 1360px) {
			.assa {
				max-height: 180px;
				max-width: : 180px;
			}
		}
		@media screen and (min-width: 1400px) {
			.assa {
				max-width: : 180px;
				max-width: : 200px;
			}
		}
	</style>
</head>

<body class="">
	<div id="wrapper">