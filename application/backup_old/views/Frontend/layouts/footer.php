    <footer id="footer">
        <div class="footer-content" style="border-top: 1px solid #f1f1f1;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="widget">
                            <div class="widget-title">BPU</div>
                            <p class="mb-5">
                                Media Informasi Komunikatif dan Informatif<br>
                                Perlu bantuan?
                            </p>
                            <a href="#" class="btn btn-inverted">Contact Us</a>
                        </div>
                    </div> 
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="widget">
                                    <div class="widget-title">Link</div>
                                    <ul class="list">
                                        <li><a href="#">Risetdikti</a></li>
                                        <li><a href="#">Forlap</a></li>
                                        <li><a href="#">LPSE</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="widget">
                                    <div class="widget-title">Page</div>
                                    <ul class="list">
                                        <li><a href="#">Berita</a></li>
                                        <li><a href="#">Pengumuman</a></li>
                                        <li><a href="#">Galeri</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="widget">
                                    <div class="widget-title">Support</div>
                                    <ul class="list">
                                        <li><a href="#">Help Desk</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                        <li><a href="#">Forum</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-content">
            <div class="container">
                <div class="copyright-text text-center">
                    <a href="<?= base_url() ?>">BPU</a> | <a href="http://www.unsri.ac.id/">Universitas Sriwijaya</a>
                    <br>
                    &copy; 2019
                </div>
            </div>
        </div>
    </footer>
</div>


<div class="modal fade " id="modalLogin" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <form action="<?= base_url('frontend/user/login');?>" method="POST">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-40 p-t-60 p-xs-20">
                            <h3>Login</h3>
                            <form class="form-grey-fields">
                                <div class="form-group">
                                    <?php
                                    $uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                    ?>
                                    <label class="sr-only">Username</label>
                                    <input placeholder="Username" name="username" class="form-control" type="text">
                                    <input type="hidden" name="uriseg" class="form-control" value="<?= $uri; ?>">
                                </div>
                                <div class="form-group m-b-5">
                                    <label class="sr-only">Password</label>
                                    <input placeholder="Password" name="password" class="form-control" type="password">
                                </div>
                                <div class="text-left form-group" style="margin-top:20px;">
                                    <button class="btn" type="submit">Login</button>
                                </div>
                            </form>
                            <p class="text-left">Belum memiliki akun? 
                                <a href="<?= base_url('register'); ?>" class="text-primary">Daftar Sekarang !</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<a id="scrollTop"><i class="icon-chevron-up1"></i><i class="icon-chevron-up1"></i></a>

<script src="<?= base_url()?>assets/frontend/js/jquery.js"></script>
<script src="<?= base_url()?>assets/frontend/js/plugins.js"></script>

<script src="<?= base_url()?>assets/frontend/js/functions.js"></script>

<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/frontend/js/plugins/revolution/css/settings.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/frontend/js/plugins/revolution/css/layers.css">
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/frontend/js/plugins/revolution/css/navigation.css">
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/frontend/js/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="<?= base_url()?>assets/frontend/js/pageloader.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js"></script>
<!-- <script src="<?= base_url()?>assets/frontend/js/jquery.form-validator.min.js"></script> -->
<script src="<?= base_url('assets/frontend/vendor/sweetalert/sweetalert.2.1.2.min.js')?>"></script>
<?php if($title=='Home'){ ?>
    <script src="<?= base_url('assets/frontend/js/plugins/components/particles.js')?>"></script>
    <script src="<?= base_url('assets/frontend/js/plugins/components/particles-animation.js')?>"></script>
<?php } ?>
<script>
    <?php if($this->session->flashdata('success')){ ?>
        swal("Success!", "<?= $this->session->flashdata('success'); ?>", "success");
    <?php } else if($this->session->flashdata('error')){?>
        swal("Error!", "<?= $this->session->flashdata('error'); ?>", "error");
    <?php }?>
</script>

<script type="text/javascript">
    var tpj = jQuery;

    var revapi22;
    tpj(document).ready(function() {
        if (tpj("#rev_slider_22_1").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_22_1");
        } else {
            revapi22 = tpj("#rev_slider_22_1").show().revolution({
                sliderType: "standard",
                jsFileLocation: "<?= base_url()?>assets/frontend/js/plugins/revolution/js/",
                sliderLayout: "fullscreen",
                dottedOverlay: "none",
                delay: 1000,
                navigation: {
                    keyboardNavigation: "off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "off",
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "vertical",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "zeus",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: false,
                        tmp: '<div class="tp-title-wrap">   <div class="tp-arr-imgholder"></div> </div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 20,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 20,
                            v_offset: 0
                        }
                    }
                },
                viewPort: {
                    enable: true,
                    outof: "wait",
                    visible_area: "80%"
                },
                responsiveLevels: [1240, 1024, 778, 480],
                visibilityLevels: [1240, 1024, 778, 480],
                gridwidth: [1240, 1024, 778, 480],
                gridheight: [868, 768, 960, 720],
                lazyType: "single",
                shadow: 0,
                spinner: "off",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "off",
                fullScreenAutoWidth: "off",
                fullScreenAlignForce: "off",
                fullScreenOffsetContainer: "",
                fullScreenOffset: "",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
    }); 
</script>
<?php if($title=='Register'){ ?>
    <script>
        $(document).ready(function () {
            $('#showPassword').on('click', function () {
                if ($('#password').attr('type') === "password") {
                    $('#password').attr('type', 'text');
                    $("#eye").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
                } else {
                    $('#password').attr('type', 'password');
                    $("#eye").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
                }
            });


            $.validate({
                modules : 'location, date, security, file',
                onModulesLoaded : function() {
                    var optionalConfig = {
                      fontSize: '12pt',
                      padding: '4px',
                      bad : 'Very bad',
                      weak : 'Weak',
                      good : 'Good',
                      strong : 'Strong'
                  };

                  $('input[name="password"]').displayPasswordStrength(optionalConfig);
              }
          });
            
            $("#submitRegister").on("click", function(e){
                if($("#registration-form").isValid()){
                    $("#submit-button").show()
                }
            });

            $("#wizard-picture").change(function(){
                readURL(this);
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

        });
    </script>
<?php } else if($title == 'My Account') { ?>

    <script>
        $(document).ready(function () {
            $('#showPassword').on('click', function () {
                if ($('#password').attr('type') === "password") {
                    $('#password').attr('type', 'text');
                    $("#eye").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
                } else {
                    $('#password').attr('type', 'password');
                    $("#eye").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
                }
            });


            $.validate({
                modules : 'location, date, security, file',
                onModulesLoaded : function() {
                    var optionalConfig = {
                      fontSize: '12pt',
                      padding: '4px',
                      bad : 'Very bad',
                      weak : 'Weak',
                      good : 'Good',
                      strong : 'Strong'
                  };

                  $('input[name="password"]').displayPasswordStrength(optionalConfig);
              }
          });
            
            $("#updatePersonal").on("click", function(e){
                if($("#personal-form").isValid()){
                    $("#submit-button").show()
                }
            });

            $("#wizard-picture").change(function(){
                readURL(this);
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }



            $("#password, #repassword").keyup(checkPasswordMatch);

        });
        
        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#repassword").val();

            if (password != confirmPassword)
                $("#divCheckPasswordMatch").html("<span class='text-danger'>Passwords do not match!</span>");
            else
                $("#divCheckPasswordMatch").html("<span class='text-success'> Passwords match.</span>");
        }
    </script>

<?php } ?>
</body>
</html>
