<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="<?= base_url()?>assets/backend/img/profile_small.jpg"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold"><?= $this->data['token']['username']; ?></span>
                        <span class="text-muted text-xs block"><?= $this->data['token']['role']; ?> <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="<?= base_url()?>" target="_blank">Lihat Website</a></li>
                        <li><a class="dropdown-item" href="<?= base_url()?>index.php/logout">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li>
                <a href="<?= base_url()?>index.php/dash"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
            </li>

            <?php if ($this->data['token']['role'] === 'admin') { ?>

                <li <?php if($title=='Artikel'){echo "class='active'"; } else {}?>>
                    <a href="<?= base_url()?>index.php/dash/artikel"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Artikel</span></a>
                </li>
                <li <?php if($title=='Slider'){echo "class='active'"; } else {}?>>
                    <a href="<?= base_url()?>index.php/dash/slider"><i class="fa fa-sliders"></i> <span class="nav-label">Slider</span></a>
                </li>

                <li <?php if($title=='Kamar' || $title == 'Penghuni Penginapan'){echo "class='active'"; } else {}?>>
                    <a href="#"><i class="fa fa-building"></i> <span class="nav-label"> Penginapan</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li <?php if($title=='Kamar'){echo "class='active'"; } else {}?>>
                            <a href="<?= base_url('index.php/dash/penginapan/kamar')?>">Daftar Kamar</a>
                        </li>
                        <li <?php if($title=='Penghuni Penginapan'){echo "class='active'"; } else {}?>>
                            <a href="<?= base_url('index.php/dash/penginapan/daftar-penghuni')?>">Daftar Penghuni</a>
                        </li>
                    </ul>
                </li>

                <li <?php if($title=='User'){echo "class='active'"; } else {}?>>
                    <a href="<?= base_url()?>index.php/dash/user"><i class="fa fa-user"></i> <span class="nav-label">User</span></a>
                </li>

            <?php } else { ?>

            <?php } ?>
        </ul>
    </div>
</nav>