<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	if(!isset($_REQUEST['JS'])){?>
		<noscript>
			<meta http-equiv="refresh" content="0; url='<?php echo basename($_SERVER['PHP_SELF']);?>/406-error'"/>
		</noscript>
		<?php
	}
	?>
	<link rel="shortcut icon" type="image/png" href="<?= base_url()?>assets/images/logo/logo-icon.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="AdityaDS | @Adityadees" />
	<meta name="description" content="Sistem informasi perdesaan">
	<meta name="keywords" content="SID, Sistem Informasi Desa, Sistem Informasi Perdesaan" />
	<title><?= $title; ?> | Desa Limbang Jaya</title>
	<link href="<?= base_url()?>assets/frontend/css/plugins.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/frontend/css/style.css" rel="stylesheet">
	<link href="<?= base_url()?>assets/frontend/css/responsive.css" rel="stylesheet"> </head>
	<body data-icon="10">
		<div class="body-inner">



