<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GIGA-MS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <//?php foreach($menus as $menu): ?>
            <//?= $menu['module']; ?>
        <//?php endforeach; ?>     -->
        <div class="image">
          <img src="<?= base_url('dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        
        <div class="info">
            <a href="#" class="d-block"><?= $menus['nama_lengkap']; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <?php foreach($menus['module'] as $menu): ?>
            <!-- <//?php var_dump($menu); ?> -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon <?= $menu[0]['icon']; ?>"></i>
                  <p>
                    <?= $menu[0]['module']; ?>
                    <i class="fas fa-angle-left right"></i>
                  </p>                
              </a>
              <ul class="nav nav-treeview">
                <?php for($x=0; $x < count($menu); $x++): ?>
                  <li class="nav-item">
                    <a href="<?= base_url($menu[$x]['route']); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p><?= $menu[$x]['caption']; ?></p>                      
                    </a>
                  </li>
                <?php endfor; ?>
              </ul>
            </li>            
          <?php endforeach ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>