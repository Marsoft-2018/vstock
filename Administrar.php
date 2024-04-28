<?php
    $logo=$_SESSION['logoNegocio'];
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Iconos/Icono.ico" />
    <title>Pagina Principal</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
    <link rel='stylesheet' href='estilosCSS/jquery-ui.css' type='text/css' />
    <link rel="stylesheet" type="text/css" href="estilosCSS/local.css" />
    <link rel="stylesheet" href="alertifyjs/css/alertify.css" />

    <link rel="stylesheet" href="alertifyjs/css/themes/bootstrap.css">
    <link rel="stylesheet" href="alertifyjs/css/themes/semantic.css">

    <link rel="stylesheet" href="estilosCSS/animate.css">
    <link rel='stylesheet' href='estilosCSS/estiloCss.css' type='text/css' />

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/jscript" src="js/jquery-ui.js"></script>
    <script src="alertifyjs/alertify.js"></script>
    <script src="js/alertify.min.js"></script>
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <script type="text/javascript" src="js/sweetalert2.js"></script>
     <!-- Site Metas --><!-- Bootstrap 5.0.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CDN para animaciones con Animatecss -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div id="capaPrincipal">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <span class="navbar-brands">Panel de Administración</span>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <div>
                        <li style="display: flex; justify-content: center;">
                            <img src='img/<?php echo $logo; ?>' style='width:150px;margin:5px;'>
                        </li>
                    </div>
                    <li class="active"><a href="#"><i class="fa fa-bullseye"></i> Menú Principal</a></li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#mnuIniciar"><i class="fa fa-fw fa-desktop"></i>
                            Inicio <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="mnuIniciar" class="collapse">
                            <a href="#" id='inventario2' title='Revisar el Inventario' onclick="cargarinventario2('<?php echo $_SESSION['idNegocio'] ?>')">
                                <i class="fa fa-fw fa-table"></i> Inventario
                            </a><br>
                            <a href="#" id='ventas' title='Ingresar al modulo de Ventas'><i class="fa fa-barcode"></i>
                                Ventas</a><br>
                            <a href="#" id='compras' title='Ingresar al modulo de Compras'><i
                                    class="glyphicon glyphicon-shopping-cart"></i> Compras</a><br>
                            <a href="#" id='devoluciones' title='Ingresar al modulo de Devoluciones'><i
                                    class="fa fa-mail-reply-all"></i> Devoluciones</a><br>
                            <a href="#" id='abonosc' title='Ingresar al modulo de Abonos a Clientes'><i
                                    class="fa fa-fw fa-edit"></i> Abonos a Clientes</a><br>
                            <a href="#" id='abonosp' title='Ingresar al modulo de Abonos a Proveedores'><i
                                    class="glyphicon glyphicon-briefcase"></i> Abonos a Proveedores</a><br>
                            <a href="#" id='gastos' title='Ingresar al modulo de gastos y servicios'><i
                                    class="fa fa-stack-overflow"></i> Gastos y/o Servicios</a>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#mnuEditar"><i
                                class="fa fa-fw fa-wrench"></i> Ajustes Generales <i
                                class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="mnuEditar" class="collapse">
                            <a href="#" id='mnuNegocio' title='Editar datos del negocio'><i
                                    class="glyphicon glyphicon-home"></i> Datos del Negocio</a><br>
                            <a href="#" id='mnuCategorias' title='Editar categorias de productos'><i
                                    class="fa fa-list-ol"></i> Categorias</a><br>
                            <a href="#" id='empleados'><i class="fa fa-users"></i> Empleados</a><br>
                            <a href="#" id='proveedores'><i class="fa fa-archive"></i> Proveedores</a><br>
                            <a href="#" id='clientes'><i class="fa fa-child"></i> Clientes</a><br>
                            <!---<a href="#"><i class="fa fa-key"></i> Usuarios</a>-->
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#mnuReportes"><i
                                class="fa fa-fw fa-bar-chart-o"></i> Reportes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="mnuReportes" class="collapse">
                            <a href="#" id='registroDeVentas' onclick='cargarRegistroDeventas()'><i
                                    class="fa fa-money"></i> Reporte de Ventas</a><br>
                            <a href="#" id='registroDeCompras' onclick='cargarRegistroDeCompras()'><i
                                    class="fa fa-suitcase"></i> Reporte de Compra</a><br>
                            <a href="#" id='registroDeAgotados' onclick='cargarRegistroDeAgotados()'><i
                                    class="fa fa-dropbox"></i> Reporte de Agotados</a><br>
                            <a href="#" id='registroDeAgotados' onclick='cargarRegistroDeResultados()'><i
                                    class="fa  fa-bar-chart-o"></i> Reporte de Resultados</a><br>
                            <a href="#" id='reporteInventario' onclick='cargarReporteInventario()'><i
                                    class="fa fa-cube"></i>Reporte del inventario</a><br>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-question-circle"></i> Ayuda</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <?php
                        require("Modelo/Conect.php");
                        require("Modelo/producto.php");
                        
                        $cont_agotados = 0;
                        $objProducto = new Producto();
                        $objProducto->IdNegocio = $_SESSION['idNegocio'];
                        foreach($objProducto->agotados() as $producto){
                            $cont_agotados++;
                        }
                        
                        if($cont_agotados>0){
                            echo "<li class='dropdown messages-dropdown'>
                       
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-bell'></i> <span class='badge'>Alertas</span> <b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                            <li class='dropdown-header'>Alertas</li>
                            <li class='message-preview'>
                                <a href='#' onclick='cargarRegistroDeAgotados()'>
                                    <span class='avatar'><i class='fa fa-bell'></i></span>
                                    <span class='message'>Existen $cont_agotados Productos Agotados</span>
                                </a>
                            </li>                            
                        </ul>
                    </li>";
                        }
                    
                    ?>

                    <!---->
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                           <?php  echo $_SESSION['userFullName']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" onclick='editarPerfil(this.id)' id='<?php  echo $_SESSION['Usuario']; ?>'><i
                                        class="fa fa-user"></i> Perfil</a></li>

                            <li class="divider"></li>
                            <li><a href="index.php"><i class="fa fa-power-off"></i> Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
            echo "<input type='hidden' ID='negNum' value='".$_GET["neg"]."'/>";
        ?>
        <div class='bloqueo' id='bloquear' style="display:flex; justify-content: center; align-items: center; ">
            <img alt="Cargando..." src='Tools/Cargando.gif'>
        </div>
        <div class='bloqueo' id='capa'></div>
        <div id="capaPagina">
            <?php
           
           ?>

            <div id='parte1' class='container'> </div>
            <div id='facturaImprimir' class='container'> </div>
        </div>
    </div>
    
    <!-- CDN de axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- CDN sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/jscript" src="js/Acciones.js"></script>
</body>

</html>