<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPU - UNSRI | Login</title>
    <link rel="icon" href="<?= base_url()?>assets/logo/logo-unsri.png" sizes="32x32" />
    <link rel="icon" href="<?= base_url()?>assets/logo/logo-unsri.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="<?= base_url()?>assets/logo/logo-unsri.png" />
    <meta name="msapplication-TileImage" content="<?= base_url()?>assets/logo/logo-unsri.png" />
    <link href="<?= base_url()?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/backend/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/backend/css/animate.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/backend/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <?php echo $this->session->flashdata('msg');?>
        <div>
            <div>
                <h1 class="logo-name">
                    <img src="<?= base_url('assets/images/logo/logo.png')?>" width="300px">
                </h1>
            </div>
            <h3>Welcome to Admin Panel</h3>
            <form class="m-t" role="form" method="POST" action="<?= base_url()?>login">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <input type="submit" name="login" class="btn btn-primary block full-width m-b" value="Login">
                <a href="#"><small>Forgot password?</small></a>
            </form>
            <p class="m-t"> 
                <small>
                    <br>Fakultas Ilmu Komputer | Universitas Sriwijaya 
                    <br>&copy; 2019
                </small> 
            </p>
        </div>
    </div>
    <script src="<?= base_url()?>assets/backend/js/jquery-3.1.1.min.js"></script>
    <script src="<?= base_url()?>assets/backend/js/popper.min.js"></script>
    <script src="<?= base_url()?>assets/backend/js/bootstrap.js"></script>
</body>
</html>
