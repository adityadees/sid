<style type="text/css">
	@media screen and (max-width: 767px) {
		#logomain {
			width: 60% !important;
			height: auto !important; 
			position: relative;
			top: 10px;
		}
		@media screen and (max-width: 767px) {
			#logo-search {
				width: 200% !important;
				height: auto !important; 
				position: relative;
				left: -80px;
				top: -5px;
			}
		}
	</style>
	<header id="header" data-transparent="true" class="dark">
		<div class="header-inner">
			<div class="container">

				<div id="logo">
					<a href="<?= base_url()?>" class="logo" data-src-dark="<?= base_url('assets/images/logo/logo.png')?>">
						<img id="logomain" src="<?= base_url('assets/images/logo/logo.png')?>" alt="BPU">
					</a>
				</div>


				<div id="search">
					<!--     <div id="search-logo"><img id="logo-search" src="<?= base_url('assets/images/logo/logo.png')?>" alt="BPU"></div>  -->
					<button id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i></button>
					<form class="search-form" action="" method="get">
						<input class="form-control" name="q" type="search" placeholder="Search..." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
						<span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
					</form>
				</div>


				<div class="header-extras">
					<ul>
						<li>
							<a id="btn-search" href="#"> <i class="icon-search1"></i></a>
						</li>
					</ul>
				</div>


				<div id="mainMenu-trigger">
					<button class="lines-button x"> <span class="lines"></span> </button>
				</div>


				<div id="mainMenu" class="green">
					<div class="container">
						<nav>
							<ul>
								<li style="color:#bbb !important;"><a  style="color:#bbb !important;" href="<?= base_url(); ?>">Home</a></li>
								<li  style="color:#bbb !important;"><a  style="color:#bbb !important;"href="<?= base_url('vmts'); ?>">VMTS</a></li>
								<li style="color:#bbb !important;"><a  style="color:#bbb !important;"href="<?= base_url('organisasi'); ?>">Organisasi</a></li>
								<li  style="color:#bbb !important;"><a  style="color:#bbb !important;"href="<?= base_url('kepakaran'); ?>">Kepakaran</a></li>
								<li  style="color:#bbb !important;"><a  style="color:#bbb !important;"href="<?= base_url('faq'); ?>">FAQ</a></li>
								<?php 
								if(isset($this->data['token_mhs']['username']) && ($this->data['token_mhs']['role'] == 'mahasiswa')) {
									?>
									<li class="dropdown-submenu"><a href="#"  style="color:#bbb !important;">Account</a>
										<ul class="dropdown-menu">
											<li><a href="<?= base_url('account'); ?>">Profil</a></li>
											<li><a href="<?= base_url('logouts'); ?>">Logout</a></li>
										</ul>
									</li>

								<?php } else {?>
									<li><a style="color:#bbb !important;" href="#" data-target="#modalLogin" data-toggle="modal">Login</a></li>
								<?php } ?>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>