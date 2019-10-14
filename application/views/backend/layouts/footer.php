                    <div class="footer">
                        <div class="float-right">
                            Introduction <strong>Dev</strong> ADS.
                        </div>
                        <div>
                            <strong>Copyright</strong> &copy; 2019
                        </div>
                    </div>

                </div>
            </div>

            <script src="<?= base_url()?>assets/backend/js/jquery-3.1.1.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/popper.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/bootstrap.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/inspinia.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/pace/pace.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/dataTables/datatables.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
            <script src="<?= base_url();?>assets/backend/js/plugins/sweetalert/sweetalert.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/validate/jquery.validate.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/select2/select2.full.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/iCheck/icheck.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/summernote/summernote-bs4.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/jquery-ui/jquery-ui.min.js"></script>
            <script src="<?= base_url()?>assets/backend/js/plugins/datapicker/bootstrap-datepicker.js"></script>



            <script>

                var IMAGE_PATH = "<?= base_url()?>";
                $(document).ready(function(){
                    $('.summernote').summernote({
                        height: 150,

                        callbacks : {
                            onImageUpload: function(image) {
                                uploadImage(image[0]);
                            }
                        }
                    });


                    function uploadImage(image) {
                        var data = new FormData();
                        data.append("image",image);
                        $.ajax ({
                            data: data,
                            type: "POST",
                            url: "<?= base_url('index.php/backend/artikel/uploader_ajax')?>",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(url) {
                                var image = IMAGE_PATH + url;
                                $('.summernote').summernote("insertImage", image);
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });
                    }


                });
            </script>

            <script>
                $(document).ready(function () {
                    $('.i-checks').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green',
                    });
                });
            </script>

            <script>
                $(document).ready(function(){
                    $('.dataTables-example').DataTable({
                        pageLength: 10,
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: []
                    });


                /*    $('.dataTables-examplez').DataTable({
                        pageLength: 25,
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},

                        {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                        }
                    }
                    ]

                });*/

            });
        </script>

        <script>
            $(document).ready(function () {
                $('.confirmation').click(function(e) {
                    e.preventDefault();
                    var linkURL = $(this).attr("href");
                    var jdl = $(this).attr("title");
                    warnBeforeRedirect(linkURL,jdl);
                });
                function warnBeforeRedirect(linkURL,jdl) {
                    swal({
                        title: "Are you sure?",
                        text: "Anda akan menghapus data " + jdl, 
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function(isConfirm) {
                      if (isConfirm) {
                          window.location.href = linkURL;
                          swal("Deleted!", "Your imaginary file has been deleted.", "success");
                      } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
                }
            });
        </script>

    </body>
    </html>
