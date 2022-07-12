<?= $this->extend('layouts/page_layout'); ?>
<?= $this->section('content'); ?>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">

    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-3">
                <div class="card card-warning card-outline shadow">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <?php
                                $imageUrl = ($data[0]['image_url'] != null ? base_url('images/users/' . $data[0]['image_url']) : base_url('images/users/placeholder300.png'));
                            ?>
                            <img src="<?= $imageUrl; ?>" alt="User Image" class="profile-user-img img-fluid img-circle">
                        </div>
                        <h3 class="profile-username text-center"><?= $data[0]['nama_lengkap']; ?></h3>
                        <p class="text-muted text-center"><?= $data[0]['bagian']; ?></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIK:</b>
                                <a href="#" class="float-right"><?= $data[0]['nik']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Jenis Kelamin:</b>
                                <a href="#" class="float-right"><?= ($data[0]['jenis_kelamin'] == 0 ? 'Laki-laki' : 'Perempuan'); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Shift:</b>
                                <a href="#" class="float-right"><?= $data[0]['shift']; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-success card-outline shadow">
                    <div class="card-header">
                        <h3 class="card-title">Ubah Password User</h3>
                    </div>
                    <form class="form-horizontal" enctype="multipart/form-data" id="userForm" name="userForm" method="post">
                        <div class="card-body">
                            <div class="form-group row">
                                <input type="hidden" value="<?= $data[0]['id'] ;?>">
                                <!-- <label for="userName" class="col-sm-2 col-form-label">User Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="userName" name="userName" placeholder="User Name" value="<?= $data[0]['user_name']; ?>">
                                </div> -->
                            </div>
                            <div class="form-group row">
                                <label for="oldPassword" class="col-sm-2 col-form-label">Password Lama</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Password Lama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newPassword" class="col-sm-2 col-form-label">Password Baru</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password Baru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirmNewPassword" class="col-sm-2 col-form-label">Kon. Password Baru</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Konfirmasi Password Baru">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="photo" class="col-sm-2 col-form-label">Ganti Photo</label>
                                <div class="col-sm-5 text-center">
                                    <img id="ajaxImgUpload" src="<?= base_url('images/placeholder300.png'); ?>" alt="Preview Image" class="profile-user-img img-fluid img-circle">
                                </div>   
                                <div class="col-sm-5 text-center">
                                    <input type="file" class="form-control" id="fInput" name="file" accept="image/*" onchange="onFileUpload(this)">
                                </div>
                            </div> -->
                        </div>
                        <div class="card-footer">
                            <!-- <div class="form-group"> -->
                                <!-- <div class="offset-sm-2 col-sm-10"> -->
                                    <button type="submit" class="btn btn-success">Submit</button>
                                <!-- </div> -->
                            <!-- </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery validation -->
    <script src="<?= base_url('plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/jquery-validation/additional-methods.min.js'); ?>"></script>    

    <!-- Sweetalert2 -->
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

    <script>
        // function onFileUpload(input, id) {
        //     id = id || '#ajaxImgUpload';
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = function (e) {
        //             $(id).attr('src', e.target.result).width(300)
        //         };
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }

        const Toast = Swal.mixin({
            toast: false,
            position: 'center',
            showConfirmButton: true,
        });        

        $('#userForm').validate({
            rules: {
                // userName: "required",
                oldPassword: {
                    required: true,
                    minlength: 5
                },
                newPassword: {
                    required: true,
                    minlength: 5
                },
                confirmNewPassword: {
                    required: true,
                    minlength: 5,
                    equalTo: '#newPassword'
                },
            },
            messages: {
                // userName: "User Name harus diisi!",
                oldPassword: {
                    required: "Password Lama harus diisi!",
                    minlength: "Password Lama minimal 5 karakter"
                },
                newPassword: {
                    required: "Password Baru harus diisi!",
                    minlength: "Password Baru minimal 5 karakter",
                },
                confirmNewPassword: {
                    required: "Konfirm Password Baru harus diisi!",
                    minlength: "Konfirm Password Baru minimal 5 karakter",
                    equalTo: "Konfirm Password Baru harus sama dengan Password Baru!"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (frm, e) {
                e.preventDefault();
                const ajaxUser = $.ajax({
                    type: 'POST',
                    url: '<?= base_url("user/updateUser"); ?>',
                    data: $(frm).serialize(),
                    dataType: 'json'
                });
                ajaxUser.done(function(returnData){
                    console.log('returnData: ', returnData);
                    if(returnData.status == 400){
                        Toast.fire({
                            icon: 'warning',
                            title: returnData.msg
                        });
                    }
                    if(returnData.status == 200){
                        Toast.fire({
                            icon: 'success',
                            title: returnData.msg,
                        });                            
                    }
                });
            }                
        });        
    </script>


<?= $this->endSection(); ?>