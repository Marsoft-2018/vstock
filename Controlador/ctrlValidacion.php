<?php 
	session_start();
    header('Content-Type: application/json');
	//include ("encript.php");
	require_once ("../Modelo/Conect.php");
	require_once '../Modelo/user.php';

	$usuario = $_POST['usuario'];
	$password = $_POST['contrasena'];

//Validación normal
  $objUsu = new User();
	$objUsu->setDatos($usuario,$password);
	echo json_encode($objUsu->login());
?>