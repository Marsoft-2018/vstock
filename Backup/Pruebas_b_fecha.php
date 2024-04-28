<?PHP
include("CONECT.php");
$mysqluser="root";
$mysqlpass="73429935";
$backupall='true';
$Copia_a_guardar='cuentas';
$NomArchivo="Copia de ".date('Y-m-d');

		$sql2="SELECT *,CURRENT_DATE AS HOY FROM backups";
		$consultab=mysql_query($sql2,$conexion) or die ("No trajo fecha");
	while($reg2=mysql_fetch_array($consultab)){
	$antes=$reg2[0];
	$hoy=$reg2[1];
	$antes2;
	$hoy2;
	$fechaHoy = explode('-',$hoy); 
	$fechaantes=explode('-',$antes);
	$AÑO=$fechaHoy[0]-$fechaantes[0];
	$MES=$fechaHoy[1]-$fechaantes[1];
	$DIA=$fechaHoy[2]-$fechaantes[2];
	$TOTALDIAS=($AÑO*360)+($MES*30)+$DIA;
	
	
	$ATRAZOSEMANAS=($TOTALDIAS/7);
						
	if (round($ATRAZOSEMANAS,0)>=1){

		//define('BACKUPDIR', 'C:\Backup'."\\");
		define('BACKUPDIR', 'C:\Backup'."\\");
		define('THISPAGE', $_SERVER['PHP_SELF']);// para crear enlaces a esta pagina ( accion del formulario, etc.)
		// si la variable NomArchivo en POST no está vacia, es que se ha enviado el formulario
		if (!empty($NomArchivo)) { 
			// ahora validaremos y verificaremos las entradas para saber lo que tenemos y abortar si hay algo mal
			$errors = array();
			$n = 0;
			/* pondremos cualquier error dentro de este array, y al final los listaremos todos para que los vea el usuario 
				   y pueda corregirlos	*/
			if (empty($NomArchivo)) { // no hay nombre de fichero
				$errors[$n] = "Debe introducir un nombre de fichero.";
				$n++;
			}
			// Ha seleccionado copiar una BD, pero no han dicho cual
			if ($backupall == 'false' AND 
					empty($Copia_a_guardar)) { 
				  $errors[$n] = "Has selecciona copiar una base de datos, ".
									"pero no especificaste cual.";
				  $n++;	
			}
		 
			if ($n > 0) { // Si hubo errores en la fase de validacion... muestra una pagina de error
				?><h1>COPIAS DE RESPALDO PARA LA BASE DE DATOS</h1>
				<h2>No se pudo realizar la copia.</h2>
				<ul>
					// recorre los errores 
					<?php foreach ($errors as $err) { 
				?><div style='background-color:#FF0000;'><li><font color='#ff0000'>
					<?php echo $err; // y muestra su texto ?>
				  </font></li></Div><?php
					}
				?>
				</ul>
				<?php
				die(); // sale del script 
			}
		 
			// Si estamos aqui, es que se ha acabado bien la validación hacemos "escape shell" a los argumentos para evitar 
			// la inyección de código recuerda que esto es solo seguridad basica, se deberian 
			// añadir mas capas para mayor seguridad
			$NomArchivo = escapeshellcmd($NomArchivo);
			$mysqluser = escapeshellarg($mysqluser);
			$mysqlpass = escapeshellcmd($mysqlpass);
			$Copia_a_guardar=escapeshellarg($Copia_a_guardar);
		 
			// Queremos copiar todas las bases de datos?
			$backupall = ($backupall == 'false') ? false : true;
		 
			// Si queremos copiar todas, ponemos esto con -A en el comando,  sino, lo ponemos con el nombre de la base de datos a copiar
			$dbarg = $backupall ? '-A' : $Copia_a_guardar;
		 
			// formamos el comando a ejecutar
			$command = "..\..\mysql\bin\mysqldump --complete-insert ".$dbarg." -u ".$mysqluser. " -p".$mysqlpass."  -r \"".BACKUPDIR.$NomArchivo."\" 2>&1";
			// creamos una cabecera y mostramos el progreso al usuario
				// Podria tomar su tiempo
			echo 'Copias de seguridad';
		 
			?><div style='width:80%;height:80px; background-color:#FFFFFF;Border-top:1px solid #000000;
					Border-left:1px solid #000000;Border-bottom:1px solid #000000;Border-right:1px solid #000000;
					letter-spacing: 2px; text-align: left; vertical-align: middle;'>
					<h1>Creando el backup, por favor espere...</h1>
					<?php
		 
			// execute the command we just set up
			system($command);
		 
			// si eligieron comprimir con bzip, entonces se hace
			if ($_POST['bzip'] == 'true') {
				system('bzip2 "'.BACKUPDIR.$NomArchivo.'"');
			}
		 
			// OK, terminamos. Digale al usuario lo que ha pasado.	
				// Si ocurrio algun error, se muestran en la llamada a system()
			?><br>El proceso llegó a su fin. 
					  Si hubo errores, Se mostrarán arriba.</h2>
			<a href="<?php echo THISPAGE;?>">
				Click aquí para continuar</a></div>
				<?php
			// y salidos, hemos terminado!
			die();
		}
		 
		// Si el formulario no se envió, entonces se muestra al usuario 
		// por primera vez con su cabecera
	echo "</td>";
	}else{
	
	}
	}
?>