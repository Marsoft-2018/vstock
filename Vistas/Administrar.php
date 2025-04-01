<?php
    $logo=$_SESSION['logoNegocio'];
    require("Modelo/Conect.php");
    require("Modelo/product.php");
                        
    $cont_agotados = 0;
    $objProduct = new Product();
    $objProduct->bussines_id = $_SESSION['idNegocio'];
    foreach($objProduct->soldOuts() as $product){
        $cont_agotados++;
    }
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Vstock - Panel</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" /> -->
    <link rel="icon" href="img/Iconos/Icono.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" /> 
    <!-- Iconos fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="complementos/css/fontawesome5.15.4.min.css"> -->

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    <link rel="stylesheet" href="DataTables/datatables.css">

    <!-- select2 combos para busqueda de datos -->
    <link href="complementos/css/select2.min.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <img src='assets/img/illustrations/logo-p.png' style='width:100%;margin:0px;'>
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
              <img src='img/<?php echo $logo; ?>' style='width:80px;margin:5px;'>
              </span>
              <!-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Vstock</span> -->
               
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Panel de administración</div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Menu principal</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="#" class="menu-link" id='inventario2' title='Revisar el Inventario' onclick="cargarInventario('<?php echo $_SESSION['idNegocio'] ?>')">
                    <i class="fa fa-boxes">&nbsp;</i> Inventario
                  </a>
                </li>
                <li class="menu-item">
                    <a href="#" id='ventas' title='Ingresar al modulo de Ventas' class="menu-link"  onclick="indexSales('<?php echo $_SESSION['idNegocio'] ?>')">
                        <i class="fa fa-barcode">&nbsp;</i>Ventas
                    </a>                 
                </li>
                <li class="menu-item">
                <a href="#" class="menu-link"  title='Ir al módulo de compras' onclick="indexPurchases('<?php echo $_SESSION['idNegocio'] ?>')">
                    <i class="fa fa-shopping-basket">&nbsp;</i> Compras
                  </a>
                </li>
                <li class="menu-item">
                    <a href="#" title='Ingresar al modulo de devoluciones' class="menu-link"  onclick="indexStockReturn('<?php echo $_SESSION['idNegocio'] ?>')">
                        <i class="fa fa-retweet">&nbsp;</i>
                        Devoluciones
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" title='Ingresar al modulo de abonos a clientes' class="menu-link"  onclick="indexPersonCredits('Customer')">
                        <i  class="fa fa-fw fa-edit">&nbsp;</i> Créditos a Clientes
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" title='Ingresar al modulo de abonos a proveedores' class="menu-link"  onclick="indexPersonCredits('Supplier')">
                        <i class="fa fa-briefcase" aria-hidden="true">&nbsp;</i> Créditos a Proveedores
                    </a>
                </li>
                <!-- <li class="menu-item">
                    <a href="#" title='Ingresar al modulo de devoluciones' class="menu-link"  onclick="cargarGastos('<?php echo $_SESSION['idNegocio'] ?>')">
                        <i class="fa fa-plug" aria-hidden="true">&nbsp;</i> Gastos y/o Servicios
                    </a>
                </li> -->
              </ul>
            </li>
            <!--
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Reportes</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account Settings</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account">Account</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-account-settings-notifications.html" class="menu-link">
                    <div data-i18n="Notifications">Notifications</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-account-settings-connections.html" class="menu-link">
                    <div data-i18n="Connections">Connections</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Authentications</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="auth-login-basic.html" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Login</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="auth-register-basic.html" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Register</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Forgot Password</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Misc</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pages-misc-error.html" class="menu-link">
                    <div data-i18n="Error">Error</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-misc-under-maintenance.html" class="menu-link">
                    <div data-i18n="Under Maintenance">Under Maintenance</div>
                  </a>
                </li>
              </ul>
            </li>-->
            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text"></span></li>
            
            <!-- Ajustes generales -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Extended UI">Ajustes generales</div>
              </a>
              <ul class="menu-sub">
                <!-- <li class="menu-item">
                  <a href="#" title='Mostrar datos del negocio' class="menu-link"  onclick="loadBussines('<?php echo $_SESSION['idNegocio'] ?>')">
                      <i class="fa fa-home" aria-hidden="true">&nbsp;</i> Datos del Negocio
                  </a>
                </li> -->
                <li class="menu-item">
                  <a href="#" title='Mostrar categorias' class="menu-link"  onclick="loadCategories('<?php echo $_SESSION['idNegocio'] ?>')">
                      <i class="fa fa-list-ol" aria-hidden="true">&nbsp;</i> Categorías
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" title='Mostrar datos del negocio' class="menu-link"  onclick="indexCustomers('<?php echo $_SESSION['idNegocio'] ?>')">
                      <i class="fa fa-child" aria-hidden="true">&nbsp;</i> Clientes
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" title='Mostrar datos del negocio' class="menu-link"  onclick="indexSuppliers('<?php echo $_SESSION['idNegocio'] ?>')">
                      <i class="fa fa-archive" aria-hidden="true">&nbsp;</i> Proveedores
                  </a>
                </li>
                <!-- <li class="menu-item">
                  <a href="#" title='Cargar modulo empleados' class="menu-link"  onclick="indexEmployes('<?php echo $_SESSION['idNegocio'] ?>')">
                      <i class="fa fa-users" aria-hidden="true">&nbsp;</i> Empleados
                  </a>
                </li> -->
              </ul>
            </li>
            
            <!-- Reportes -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon fa fa-chart-bar"></i>
                <div data-i18n="Extended UI">Reportes</div>
              </a>
              <ul class="menu-sub">
                <!-- <li class="menu-item">
                  <a href="#" title='Mostrar datos del negocio' class="menu-link"  onclick="loadBussines('<?php echo $_SESSION['idNegocio'] ?>')">
                      <i class="fa fa-home" aria-hidden="true">&nbsp;</i> Datos del Negocio
                  </a>
                </li> -->
                <li class="menu-item">
                  <a href="#" title='Mostrar categorias' class="menu-link"  onclick="loadSalesRegister('<?php echo $_SESSION['idNegocio'] ?>')">
                  <i class="far fa-money-bill-alt"></i>&nbsp;</i> De ventas
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" title='Mostrar datos del negocio' class="menu-link"  onclick="loadPurchaseRegister('<?php echo $_SESSION['idNegocio'] ?>')">
                      <i class="fa fa-suitcase" aria-hidden="true">&nbsp;</i> De Compras
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" title='Mostrar datos del negocio' class="menu-link"  onclick="loadSoldOutRegister('<?php echo $_SESSION['idNegocio'] ?>')">
                      <i class="fa fa-box-open" aria-hidden="true">&nbsp;</i> Productos Agotados
                  </a>
                </li>
                <!-- <li class="menu-item">
                  <a href="#" title='Mostrar datos del negocio' class="menu-link"  onclick="indexSuppliers('<?php echo $_SESSION['idNegocio'] ?>')">
                  <i class="fa fa-chart-line" aria-hidden="true"></i>&nbsp;</i> Resultados
                  </a>
                </li> -->
              </ul>
            </li>
            <!-- <li class="menu-item">
              <a href="icons-boxicons.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Boxicons</div>
              </a>
            </li> -->

            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Ayuda</span></li>
            <li class="menu-item">
              <a
                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                target="_blank"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <?php
                  if($cont_agotados>0){
                ?> 
                    <li class="nav-item lh-1 me-3">
                    <button type="button" class="btn btn-primary position-relative"  onclick="loadSoldOutRegister('<?php echo $_SESSION['idNegocio'] ?>')">
                      <i class="fa fa-bell"> &nbsp;</i>Articulos Agotados
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $cont_agotados ?>
                        <span class="visually-hidden">unread messages</span>
                      </span>
                    </button>
                    </li>
                  <?php
                  }
                  ?>
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php  echo $_SESSION['userFullName']; ?></span>
                            <small class="text-muted"><?php  echo $_SESSION['rol']; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" onclick="loadProfile('<?php echo $_SESSION['Usuario'] ?>')">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Mi perfil</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="index.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Salir</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y" >
                <div class="card p-3" id="parte1">
                    <div class="row">
                        <div class="col-lg-8 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                  <div class="col-sm-7">
                                      <div class="card-body">
                                      <h5 class="card-title text-primary">Bienvenido <?php  echo $_SESSION['userFullName']; ?></h5>
                                      <!-- <p class="mb-4">
                                          You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                          your profile.
                                      </p>                                 -->
                                  </div>
                                </div>
                                <div class="col-sm-5 text-center text-sm-left">
                                    <div class="card-body pb-0 px-0 px-md-4">
                                      <img
                                          src="assets/img/illustrations/man-with-laptop-light.png"
                                          height="140"
                                          alt="View Badge User"
                                          data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                          data-app-light-img="illustrations/man-with-laptop-light.png"
                                      />
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4 col-md-4 order-1">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                            <img
                                                src="assets/img/icons/unicons/chart-success.png"
                                                alt="chart success"
                                                class="rounded"
                                            />
                                            </div>
                                            <div class="dropdown">
                                            <button
                                                class="btn p-0"
                                                type="button"
                                                id="cardOpt3"
                                                data-bs-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Profit</span>
                                        <h3 class="card-title mb-2">$12,628</h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                            <img
                                                src="assets/img/icons/unicons/wallet-info.png"
                                                alt="Credit Card"
                                                class="rounded"
                                            />
                                            </div>
                                            <div class="dropdown">
                                            <button
                                                class="btn p-0"
                                                type="button"
                                                id="cardOpt6"
                                                data-bs-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                            </div>
                                        </div>
                                        <span>Sales</span>
                                        <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                     -->
                    </div>
                </div>
            </div>
            <!-- / Content -->

            

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script> -->
    <!-- <script src="assets/vendor/libs/jquery/jquery.js"></script> -->
    <script src="assets/js/plugins/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    
    <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/plugins/dataTables.responsive.min.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    
    <!-- CDN de axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- CDN sweetalert2 -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="assets/js/plugins/sweetalert2.all.min.js"></script>

  <!-- Complementos para desarrollo-->
   <script src="complementos/js/axios.min.js"></script>
   <script src="complementos/js/sweetalert2@11.js"></script>

   
    <!-- CUSTOM CODE -->
    <script src="js/bussines.js"></script>
    <script src="js/users.js"></script>
    <script src="js/products.js"></script>
    <script src="js/Categories.js"></script>
    <script src="js/personCredits.js"></script>
    <script src="js/customers.js"></script>
    <script src="js/suppliers.js"></script>
    <script src="js/employes.js"></script>
    <script src="js/employePayments.js"></script>
     <script src="js/app.js"></script>
    <script src="js/shoppingCar.js"></script>
    <script src="js/purchaseCar.js"></script>
    <script src="js/payForms.js"></script>
    <script src="js/reports.js"></script>
    
    <script src="DataTables/datatables.js"></script>
    <script src="complementos/js/select2.min.js"></script>
  </body>
</html>
