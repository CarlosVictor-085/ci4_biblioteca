
<div class="layout-wrapper layout-content-navbar">
<div class="layout-container">
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
          <div class="app-brand demo" style="margin-left">
          <a id="menuitem" href="<?=base_url('Home/index')?>" class="d-flex align-items-center text-decoration-none ">
            <img src="<?=base_url('assets/img/sgar.png')?>" alt="Logo" class="me-3" width="50" height="50">
            <span class="app-text demo menu-text fw-bolder fs-5 ">Biblioteca</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->

            <li class="menu-item">
              <a href="<?=base_url('Home/index')?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Home</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="<?=base_url('Aluno/index')?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-id-card"></i>
                <div data-i18n="Analytics">Aluno</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="<?=base_url('Autor/index')?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-book-reader"></i>
                <div data-i18n="Analytics">Autor</div>
              </a>
            </li>
            <?php if(session()->get('nome') =='admin'): ?>
            <li class="menu-item">
              <a href="<?=base_url('Usuario/index')?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user"></i>
                <div data-i18n="Analytics">Usuario</div>
              </a>
            </li>
            <?php endif; ?>

            <li class="menu-item">
              <a href="<?=base_url('Editora/index')?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-message-square-edit"></i>
                <div data-i18n="Analytics">Editora</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="<?=base_url('Obra/index')?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-book"></i>
                <div data-i18n="Analytics">Obra</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="<?=base_url('Livro/index')?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-book-content"></i>
                <div data-i18n="Analytics">Livro</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="<?=base_url('Emprestimo/index')?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-send"></i>
                <div data-i18n="Analytics">Emprestimo</div>
              </a>
            </li>

            
          </ul>
            </aside>
            <div class="layout-page">
          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a id="menuToggle" class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow show" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                    <div class="nav-link active aria-current m-2">
                    <img src="http://localhost/ci4_biblioteca/public/assets/img/avatars/avatar.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  
                  <ul class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="http://localhost/ci4_biblioteca/public/assets/img/avatars/avatar.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo session()->get('nome');?></span>
                            <small class="text-muted"><?php echo session()->get('email');?></small>
                          </div>
                        </div>
                      </a>
                    <li>
                    <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Sair </span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </nav>
            <br>
          <!---Barra de Pesquisa e Navegação de usuario--->
  <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="http://localhost/ci4_biblioteca/public/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="http://localhost/ci4_biblioteca/public/assets/vendor/libs/popper/popper.js"></script>
    <script src="http://localhost/ci4_biblioteca/public/assets/vendor/js/bootstrap.js"></script>
    <script src="http://localhost/ci4_biblioteca/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="http://localhost/ci4_biblioteca/public/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="http://localhost/ci4_biblioteca/public/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="http://localhost/ci4_biblioteca/public/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="http://localhost/ci4_biblioteca/public/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', (event) => {
    const menuToggle = document.getElementById('menuToggle');
    const htmlElement = document.documentElement;
  
    menuToggle.addEventListener('click', () => {
      if (htmlElement.classList.contains('layout-menu-expanded')) {
        htmlElement.classList.remove('layout-menu-expanded');
      } else {
        htmlElement.classList.add('layout-menu-expanded');
      }
    });
  });
    </script>