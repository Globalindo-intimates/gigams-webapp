<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css')?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>">    

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">    

    <style type="text/css">
        body {
            background: #c5cae9; /* fallback color */
            background: linear-gradient( to bottom right, #c5cae9, #3f51b5);
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            height: 100%;
        }
        
        /* html,body{
            height: 100%;
        }

        .container{
            height: 100%;
        } */
    </style>
</head>
<body class="h-100">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-10 col-lg-10">
                <div class="card card-warning shadow">
                    <div class="card-header">
                        <h3 class="card-title">Login or Register</h3>
                    </div>
                    <div class="card-body">
                        <h4>Authentication:</h4>
                        <div class="row">
                            <div class="col-4 col-sm-4">
                                <div class="nav flex-column nav-tabs h-100">
                                    <a class="nav-link active" id="vert-tabs-login-tab" data-toggle="pill" href="#vert-tabs-login" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Login</a>
                                    <a class="nav-link" id="vert-tabs-register-tab" data-toggle="pill" href="#vert-tabs-register" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Register</a>
                                </div>
                            </div>
                            <div class="col-4 col-sm-4">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane text-left fade show active" id="vert-tabs-login" role="tabpanel" aria-labelledby="vert-tabs-login-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <form id="formLogin">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                            <div class="input-group-text">
                                                                <span class="fas fa-eye toggle-password-login"></span>
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 float-right">
                                                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                                                        </div>
                                                    </div>
                                                </form>                                                                    

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-register" role="tabpanel" aria-labelledby="vert-tabs-register-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <form id="formRegister">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-address-card"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-user"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" name="psw" id="psw" placeholder="Password">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                            <div class="input-group-text">
                                                                <span class="fas fa-eye toggle-password-register"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock"></span>
                                                            </div>
                                                            <div class="input-group-text">
                                                                <span class="fas fa-eye toggle-confirmPassword-register"></span>
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 float-right">
                                                            <button type="submit" class="btn btn-primary">Register</button>
                                                        </div>
                                                    </div>
                                                </form>                                                                    
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-sm-4">
                                <img src="<?= base_url('images/work.jpg'); ?>" alt="working image" width="288" height="310">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('dist/js/adminlte.min.js'); ?>"></script>

    <!-- Jquery validation -->
    <script src="<?= base_url('plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/jquery-validation/additional-methods.min.js'); ?>"></script>

    <!-- Sweetalert2 -->
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

    <script>
        $(function(){
            var Toast = Swal.mixin({
                toast: false,
                position: 'center',
                showConfirmButton: true,
            });

            $('#formLogin').validate({
                rules: {
                    user_name: "required",
                    password: "required",
                },
                messages: {
                    user_name: "User Name harus diisi!",
                    password: "Password harus diisi!",
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form, e) {
                    e.preventDefault();
                    const ajaxLogin = $.ajax({
                        type: 'POST',
                        url: '<?= base_url("auth/login"); ?>',
                        data: $(form).serialize(),
                        dataType: 'json'
                    });
                    ajaxLogin.done(function(returnData){
                        console.log('returnData: ', returnData);
                        if(returnData.status == 400){
                            Toast.fire({
                                icon: 'warning',
                                title: returnData.message
                            });
                        }
                        if(returnData.status == 200){
                            Toast.fire({
                                icon: 'success',
                                title: returnData.message,
                                didClose: () => {
                                    // localStorage.removeItem('idUser');
                                    // localStorage.setItem('idUser', returnData.user_id);
                                    window.open('<?= base_url("dashboard"); ?>', '_self');
                                }
                            });                            
                        }
                    });
                }                
            }); 

            $('#formRegister').validate({
                rules: {
                    nik: "required",
                    user_name: "required",
                    psw: {
                        required: true,
                        minlength: 5
                    },
                    confirmPassword: {
                        required: true,
                        minlength: 5,
                        equalTo: '#psw'
                    },
                },
                messages: {
                    nik: "NIK harus diisi!",
                    user_name:  "User Name harus diisi!",
                    psw: {
                        required: "Password harus diisi!",
                        minlength: "Password minimal 5 karakter"
                    },
                    confirmPassword: {
                        required: "Confirm Password harus diisi!",
                        minlength: "Confirm Password minimal 5 karakter",
                        equalTo: "Confirm Password harus sama dengan Password!"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (frm, e) {
                    e.preventDefault();
                    const ajaxRegister = $.ajax({
                        type: 'POST',
                        url: '<?= base_url("auth/register"); ?>',
                        data: $(frm).serialize(),
                        dataType: 'json'
                    });
                    ajaxRegister.done(function(returnData){
                        console.log('returnData: ', returnData);
                        if(returnData.status == 400){
                            Toast.fire({
                                icon: 'warning',
                                title: returnData.message
                            });
                        }
                        if(returnData.status == 200){
                            Toast.fire({
                                icon: 'success',
                                title: returnData.message,
                                didClose: () => {
                                    window.open('<?= base_url("auth/getAuth"); ?>', '_self');                                    
                                }
                            });                            
                        }
                    });
                }                
            });            
        })
        $('body').on('click', '.toggle-password-login', function(){
            $(this).toggleClass('fas fas fa-eye-slash');
            let input = $('#password');
            if(input.attr('type') == 'password'){
                input.attr('type', 'text')
            }else{
                input.attr('type', 'password')
            }
        })        

        $('body').on('click', '.toggle-password-register', function(){
            $(this).toggleClass('fas fas fa-eye-slash');
            let input = $('#psw');
            if(input.attr('type') == 'password'){
                input.attr('type', 'text')
            }else{
                input.attr('type', 'password')
            }
        })        

        $('body').on('click', '.toggle-confirmPassword-register', function(){
            $(this).toggleClass('fas fas fa-eye-slash');
            let input = $('#confirmPassword');
            if(input.attr('type') == 'password'){
                input.attr('type', 'text')
            }else{
                input.attr('type', 'password')
            }
        })        
    </script>
</body>
</html>