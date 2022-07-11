<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIGA-MS</title>

    <?= $this->include('layouts/css'); ?>
    <?= $this->include('layouts/js'); ?>

</head>

<!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url('dist/img/AdminLTELogo.png'); ?>" alt="AdminLTELogo" height="60" width="60">
        </div>
        
        <?= $this->include('layouts/navbar'); ?>

        <!-- <//?= $this->include('Modules\Dashboard\Views\layout\sidebar'); ?> -->
        <?= view_cell('/App/Libraries/SidebarLibrary::loadMenus'); ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard v2</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <?= $this->include('layouts/breadcrumb'); ?>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>  
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm6 com-md-3">
                            <?= $this->renderSection('content'); ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?= $this->include('layouts/footer'); ?>
    </div>

    
</body>
</html>