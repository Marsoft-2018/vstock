<?
$conexion=mysql_connect("localhost","root","73429935") or die ("Sin Servicio LocalHost");
mysql_select_db("CUENTAS",$conexion) or die ("NO SE PUDO SELECCIONAR LA BASE DE DATOS");
$consulta ="SELECT ID_cliente FROM clientes WHERE id_cliente='73429935';";
$result=mysql_query($consulta);

echo $result;
echo "<br>dos\n".$result[0];
if (isset($result))
	{
		echo "<script language='javascript'>"; 
		echo "alert('La fecha inicial debe ser menor a la fecha final del ciclo escolar');";
		//echo "document.location.href='captura_ciclo-escolar.php';"; //redireccionar a la pàgina de captura
		echo "</script>";
	
		while ($row=mysql_fetch_array($result)){
			if (!isset($row[0]))
				{echo "La Variable esta vacia";}
			else
				{echo $row[0];}	
		}
	
	}
	else
	{echo "No hay resultado";}


?>