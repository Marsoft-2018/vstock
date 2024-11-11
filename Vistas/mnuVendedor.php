
<?php
    $usuario=$_POST['usuarios'];
    $contrasena=$_POST['contrasena'];

    $logo=0;
    
    require('Conexiones/Usuarios.php');
    require('Conexiones/Negocio.php');

    $logoSql= new Negocio();
    $buscar = $logoSql->cargarLogo($usuario,$contrasena);

    while($lg=mysql_fetch_array($buscar)){
        $logo=$lg[0];
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="icon" href="img/Iconos/Icono.ico" />
    <title>Count2015 Pagina Principal</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
    <link rel='stylesheet' href='estilosCSS/jquery-ui.css' type='text/css' />	
    <link rel="stylesheet" type="text/css" href="estilosCSS/local.css" />
    <link rel="stylesheet" href="alertifyjs/css/alertify.css" />

    <link rel="stylesheet" href="alertifyjs/css/themes/bootstrap.css">
    <link rel="stylesheet" href="alertifyjs/css/themes/semantic.css">

    <link rel="stylesheet" href="estilosCSS/animate.css">
    <link rel='stylesheet' href='estilosCSS/estiloCss.css' type='text/css' />
    <link rel="stylesheet" href="estilosCSS/sweetalert2.css">
    <link rel="stylesheet" href="estilosCSS/sweetalert.css" />

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/jscript" src="js/jquery-ui.js"></script>
    <script src="alertifyjs/alertify.js"></script>
    <script src="js/alertify.min.js"></script>
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <script type="text/javascript" src="js/sweetalert2.js"></script>
    <style type="text/css">
    .facturaImp{
        display: none;
    }
    @media print
    {
        body * { visibility: hidden; }
        #capaPagina{ visibility: hidden}
        #facturaImprimir * { visibility: visible; }
        #facturaImprimir { position: absolute; top: 10px; left: 0px;height: auto; width: 90%;}   
        
        .facturaImp{
            display: block;
            visibility:visible;
        }
    }
</style>
</head>
<body>
    <div id="capaPrincipal">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <span class="navbar-brand">Panel de Administración</span>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active"><img src='img/<?php echo $logo; ?>' style='width:215px;margin:5px;'></li>
                    <li class="active"><a href="#"><i class="fa fa-bullseye"></i> Menú Principal</a></li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#mnuIniciar"><i class="fa fa-fw fa-desktop"></i> Inicio <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="mnuIniciar" class="collapse">
                            <a href="#" id='ventas' title='Ingresar al modulo de Ventas'><i class="fa fa-barcode"></i> Ventas</a><br>
                        </ul>
                    </li>                   
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#mnuReportes"><i class="fa fa-fw fa-bar-chart-o"></i> Reportes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="mnuReportes" class="collapse">
                            <a href="#" id='registroDeAgotados' onclick='cargarRegistroDeAgotados()'><i class="fa fa-dropbox"></i> Reporte de Agotados</a><br>
                            <a href="#" id='reporteInventario' onclick='cargarReporteInventario()'><i class="fa fa-cube"></i>Reporte del inventario</a><br>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-question-circle"></i> Ayuda</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                   <?php
                        $sqlAgotados=mysql_query("SELECT inv.id_prod FROM inventario inv WHERE inv.`CANT_FINAL`<=inv.`CANTIDAD_MIN`;");
                        $res=mysql_num_rows($sqlAgotados);
                        if($res>0){
                            echo "<li class='dropdown messages-dropdown'>
                       
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-bell'></i> <span class='badge'>Alertas</span> <b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                            <li class='dropdown-header'>Alertas</li>
                            <li class='message-preview'>
                                <a href='#' onclick='cargarRegistroDeAgotados()'>
                                    <span class='avatar'><i class='fa fa-bell'></i></span>
                                    <span class='message'>Existen $res Products Agotados</span>
                                </a>
                            </li>                            
                        </ul>
                    </li>";
                        }
                    
                    ?>
                   
                    <!---->
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php $dtusuario = new Usuario(); $dtusuario->cargarDatos($usuario); ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" onclick='editarPerfil(this.id)' id='<?php echo $usuario;?>'><i class="fa fa-user"></i> Perfil</a></li>
                            
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
        <div class='bloqueo' id='bloquear'><img alt="Cargando..." src='tools/indicador.gif'><br><img alt="Cargando..." src='tools/cargando.gif'></div>
        <div class='bloqueo' id='capa'></div>
        <div id="capaPagina">
          <?php
           
           ?>
           
            <div id='parte1' class='container'>   </div>
            <div id='facturaImprimir' class='container'>   </div>	
        </div>
    </div>
    <script type='text/javascript'> 
        
    </script>
    <script type="text/jscript" src="js/Acciones.js"></script>
</body>
</html>