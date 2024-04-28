<?php 
  session_start();
  if (!isset($_SESSION['idNegocio'])) {
    header("Location: /index.php");
  }else{
    switch ($_SESSION['rol']) {
      case 'Admin':
        include("Vistas/Administrar.php");
        //echo "Administrador";
        //echo $_SESSION['Rol'];
        break;
      default:
        include("No_auto.php");
        //echo $_SESSION['idNegocio'];
        //echo $_SESSION['Rol'];
        break;
    }
  }
 ?>