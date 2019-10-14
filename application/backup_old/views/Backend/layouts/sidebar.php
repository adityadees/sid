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
                        <li><a class="dropdown-item" href="<?= base_url()?>logout">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li>
                <a href="<?= base_url()?>dash"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
            </li>

            <?php if ($this->data['token']['role'] === 'admin') { ?>

                <li <?php if($title=='Artikel'){echo "class='active'"; } else {}?>>
                    <a href="<?= base_url()?>dash/artikel"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Artikel</span></a>
                </li>
                <li <?php if($title=='Slider'){echo "class='active'"; } else {}?>>
                    <a href="<?= base_url()?>dash/slider"><i class="fa fa-sliders"></i> <span class="nav-label">Slider</span></a>
                </li>

                <li <?php if($title=='User'){echo "class='active'"; } else {}?>>
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Kepakaran</span></a>
                </li>

                <li <?php if($title=='Pengujian Halal'){echo "class='active'"; } else {}?>>
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Pengujian Halal</span></a>
                </li>
                
                <li <?php if($title=='Manajemen Graha'){echo "class='active'"; } else {}?>>
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Manajemen Graha</span></a>
                </li>

                <li <?php if($title=='Apartemen' || $title=='Rusunawa' || $title=='Wisma' || $title=='Penghuni' || $title=='Validasi'){echo "class='active'"; } else {}?>>
                    <a href="#"><i class="fa fa-building"></i> <span class="nav-label">Manajemen Asrama</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li <?php if($title=='Apartemen'){echo "class='active'"; } else {}?>>
                            <a href="<?= base_url('dash/asrama/apartemen')?>">Apartemen</a>
                        </li>
                        <li <?php if($title=='Rusunawa'){echo "class='active'"; } else {}?>>
                            <a href="<?= base_url('dash/asrama/rusunawa')?>">Rusunawa</a>
                        </li>
                        <li <?php if($title=='Wisma'){echo "class='active'"; } else {}?>>
                            <a href="#">Wisma</a>
                        </li>

                        <li <?php if($title=='Penghuni' || $title=='Validasi'){echo "class='active'"; } else {}?>>
                            <a href="#" id="damian">Data Penghuni <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li <?php if($title=='Penghuni'){echo "class='active'"; } else {}?>>
                                    <a href="<?= base_url('dash/pa/daftar-penghuni')?>">Daftar Penghuni</a>
                                </li>
                                <li <?php if($title=='Validasi'){echo "class='active'"; } else {}?>>
                                    <a href="<?= base_url('dash/pa/validasi')?>">Validasi</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li <?php if($title=='User'){echo "class='active'"; } else {}?>>
                    <a href="<?= base_url()?>dash/user"><i class="fa fa-user"></i> <span class="nav-label">User</span></a>
                </li>

            <?php } else { ?>

            <?php } ?>
        </ul>
    </div>
</nav>
<!-- 
kepakaran
pengujian halal
manajemen graha
manajemen asrama
- apartemen
- rusunawa
- wisma
- data penghuni
-->
