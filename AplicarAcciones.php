<?php
	require_once('Conexiones/Conect.php');
	
	if ($_POST['Edtabla']==1){
		$Tabla='inventario';
	}
	if ($_POST['Edtabla']==2){
		$Tabla='empleados';
	}
	if ($_POST['Edtabla']==3){
		$Tabla='user1';
	}
	if ($_POST['Edtabla']==4){
		$Tabla='facturaTemp';
	}
	
	$accion=$_POST['accion'];
	
	//echo "Funciona el codigo hasta aquí, el listado de valores de las variables es el sig:La accion es $accion, la tabla es: $Tabla<br>";
	
	if ($accion=='modificar') {
		$idArticulo=$_POST['idArticulo'];
    $idArticuloNew=$_POST['idArticuloNuevo'];
		$Articulo=$_POST['NombreArticulo'];
		$Referencia=$_POST['Referencia'];
		$precioCompra=$_POST['precioCompra'];
		$precioVenta=$_POST['precioVenta'];
		$cantInicial=$_POST['cantInicial'];
		$compras=$_POST['compras'];
		$ventas=$_POST['ventas'];
		$devoluciones=$_POST['devoluciones'];
		$cantFinal=$_POST['cantFinal'];
		$cantMinima=$_POST['cantMinima'];
        $idNegocio=$_POST['NegocioID'];
        $idCategoria=$_POST['catId'];
		$campos=array();
	 	if ($Tabla=='inventario'){
			//$sql=mysql_query("");
            $campos[0]=$idArticulo;
            $campos[1]=$idNegocio;
            $campos[2]=$idArticuloNew;
            $campos[3]=$Articulo;
            $campos[4]=$Referencia;
            $campos[5]=$precioCompra;
            $campos[6]=$precioVenta;
            $campos[7]=$cantInicial;   
            $campos[8]=$cantFinal;            
            $campos[9]=$cantMinima;
            $campos[10]=$idCategoria;
			//echo "Funciona el codigo hasta aquí, el listado de valores de las variables es el sig:La accion es $accion, la tabla es: $Tabla<br>";
            $sqlArticulo=new Inventario();
            
            $sqlActualiza=$sqlArticulo->Modificar($campos[0],$campos[1],$campos[2],$campos[3],$campos[4],$campos[5],$campos[6],
                                                  $campos[7],$campos[8],$campos[9],$campos[10]);
			
		}else if($Tabla=='empleados'){
			//$sql=mysql_query("UPDATE reposiciones_cargador SET `CASO`='".$caso."' WHERE `Id` =".$IDParte.";");
		}else if($Tabla=='user1'){			
			//$sql=mysql_query("UPDATE reposiciones_baterias SET `CASO`='".$caso."' WHERE `Id` =".$IDParte.";");
		}
	}else if ($accion=='eliminar') {
		echo "Funciona el codigo hasta la funcion eliminar, el listado de valores de las variables es el sig:La accion es $accion, la tabla es: $Tabla<br>";
		if ($Tabla=='inventario'){
			//$sql=mysql_query("");
            $idArticulo=$_POST['idArticulo'];
            $idNegocio=$_POST['NegocioID'];
            $sqlArticulo=new Inventario();            
            $sqlElimina=$sqlArticulo->Eliminar($idArticulo,$idNegocio);
		}else if($Tabla=='empleados'){
			//$sql=mysql_query("UPDATE reposiciones_cargador SET `CASO`='".$caso."' WHERE `Id` =".$IDParte.";");
		}else if($Tabla=='user1'){			
			//$sql=mysql_query("UPDATE reposiciones_baterias SET `CASO`='".$caso."' WHERE `Id` =".$IDParte.";");
		}
		
		
	}else if ($accion=='agregar') {	
		
		$idArticulo=$_POST['idArticulo'];
		$Articulo=$_POST['NombreArticulo'];
		$Referencia=$_POST['Referencia'];
		$precioCompra=$_POST['precioCompra'];
		$precioVenta=$_POST['precioVenta'];
		$cantInicial=$_POST['cantInicial'];
		$cantFinal=$_POST['cantFinal'];
		$cantMinima=$_POST['cantMinima'];
    $idNegocio=$_POST['NegocioID'];
    $idCategoria=$_POST['catId'];
    $medida = $_POST['medida'];

		$campos=array();
	 	if ($Tabla=='inventario'){
			//$sql=mysql_query("");
            $campos[0]=$idArticulo;
            $campos[1]=$Articulo;
            $campos[2]=$Referencia;
            $campos[3]=$precioCompra;
            $campos[4]=$precioVenta;
            $campos[5]=$cantInicial;          
            $campos[6]=$cantMinima;
            $campos[7]=$idNegocio;
            $campos[8]=$idCategoria;
            $campos[9]=$medida;
			//echo "Funciona el codigo hasta aquí, el listado de valores de las variables es el sig:La accion es $accion, la tabla es: $Tabla<br>";
            $sqlArticulo=new Inventario();            
            $sqlAgregar=$sqlArticulo->Agregar($campos[0],$campos[1],$campos[2],$campos[3],$campos[4],$campos[5],$campos[6],$campos[7],$campos[8],$medida);
			//Agregar($id_prod,$ARTICULO,$REFERENCIA,$PRECIO_COMPRA,$PRECIO_VENTA,$CANT_INICIAL,$CANTIDAD_MIN,$idNeg1,$id_categoria)
            
		}else if($Tabla=='empleados'){
			//$sql=mysql_query("UPDATE reposiciones_cargador SET `CASO`='".$caso."' WHERE `Id` =".$IDParte.";");
		}else if($Tabla=='user1'){			
			//$sql=mysql_query("UPDATE reposiciones_baterias SET `CASO`='".$caso."' WHERE `Id` =".$IDParte.";");
		}
		
	}
	
?>