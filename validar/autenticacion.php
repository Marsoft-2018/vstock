<?PHP
	 include ("../Conexiones/Usuarios.php");
	 
	 
	 $usuario=$_GET["usu"];
	 $codigo=$_GET["pass"];
	 //$codigo="S180116";
	 $busquedaE;
	 $busquedaUS;
	 
	 //echo "la variable codest= ".$votante;
	 
	if (isset($usuario)){
        $sqlUsuario=new Usuario();
		$consulta2=$sqlUsuario->Validar($usuario,$codigo); 
		$busquedaUS=Mysql_num_rows($consulta2);
		if ($busquedaUS>0){
			while($reg=Mysql_fetch_array($consulta2)){
				if ($reg[2]=="Admin"){
					echo "Administrar.php?neg=$reg[3]";
				}else if($reg[2]=="Usuario"){
					//echo "Usuario.php";
                    echo "mnuVendedor.php?neg=$reg[3]";
				}
			}
		}else{
			echo "No_auto.php";	 				
		}	 			
	}	
?>
