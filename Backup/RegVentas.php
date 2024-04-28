<html>
<head>
	<title></title>
<? include('estiloscss/estilo1.css');
include('estiloscss/nobar.css');
 ?>
<script LANGUAGE="JavaScript">
<!--
if (top == self) self.location.href = "http://localhost/cuentas/";
// -->
</script>
<script>
function Nivel(){
var informacion=new Array();
informacion=document.Fdatos.Lgrados.value.split("Ç");
document.Fdatos.grado.value=informacion[0];
document.Fdatos.nivel.value=informacion[1];

}
</script>	
<STYLE>
<!--
Body {
	SCROLLBAR-FACE-COLOR: #0099DD;
	SCROLLBAR-HIGHLIGHT-COLOR: #00CCFF;
	SCROLLBAR-DARKSHADOW-COLOR: #0000FF;
	SCROLLBAR-SHADOW-COLOR: #8000CC;
	SCROLLBAR-3DLIGHT-COLOR: #00CCFF;
	SCROLLBAR-ARROW-COLOR: #0000FF;
	SCROLLBAR-TRACK-COLOR: #99FF00;
}
-->
</STYLE>
</head>
<body oncontextmenu="return false"  
bottommargin="0" leftmargin="0" marginheiht="0" marginwidth="0" rightmargin="0" topmargin="0" 
 bgcolor=#0066CC>
<table width="100%" cellpadding="0" cellspacing="0" border="2" height="10">
<TR bgColor=#000000>
	    <TD HEIGHT="10" align=CENTER width=87%><font color="#FFFFFF">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		MODULO MOVIMIENTOS</FONT></TD>
        <TD HEIGHT="10" align=middle bgcolor="#99FF00" >Control Contable ®</TD>
 </TR>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0" height="80%" >
	<tr valign="top">
		
		<td width="100%"><BR><BR>
			<table width="100%" cellpadding="6" cellspacing="0" border="0" >
				<tr valign="top">
					<td width="100%">
					<center>
					<table border=2 bgcolor="#99CCFF" cellpadding="6" width="98%" BACKGROUND="TOOLS/FND1.bmp">
					<tr>
						<td colspan=4 bgcolor=#227515 ALIGN=center>
							<div CLASS=POS><img name='icono' alt='' src='tools/ventas.png' height='30px' width='30px'></div>
							<div><b><font color=#FFFFFF>TABLA VENTAS</font></div>	
						</td>
					<Tr>
					<tr>
						<td><CENTER>
							<TABLE BORDER=1 style='BORDER-COLLAPSE: collapse' width="98%" class='filas'>
							<TR bgColor=#20ccff class='filas' align='center'>
								<TD class='filas'>ID</TD>
								<TD class='filas'>ARTICULO</TD>
								<TD class='filas'>CANT VENDIDA</TD>
								<TD class='filas'>VALOR UNIT</TD>
								<TD class='filas'>VALOR TOTAL VENTA</TD>
								<TD class='filas'>FECHA</TD>
								<TD class='filas'>Factura No.</TD>
								<?php 
									$cnx=@mysql_connect("localhost","root","73429935");
									if (!$cnx){
									echo "Error al intentar conectarse con el servidor MySQL<br>";
									exit();
									} 
									$data= @mysql_select_db("cuentas",$cnx);
									if (!$data){
									echo "la Data no Existe<br>";
									exit();
									} 
									$campos=mysql_query("SELECT ID,SUM(CANTIDAD),VALOR_UNITARIO,SUM(VALOR_TOTAL),TIPO_MOVIMIENTO,FECHA,FACTURA 
														 FROM movimientos WHERE TIPO_MOVIMIENTO='venta' 
														 GROUP BY FECHA , ID 
														 ORDER BY FECHA;");
									if (!$campos){
									echo "Error: Tabla Sin Campos <br>".mysql_error();
									exit();
									}
								?>
							</tr>
							<?php 
							$i=0;
							while($reg=mysql_fetch_array($campos)){ 
							if ($i==0){
							echo "<TR BGCOLOR='WHITE' class='filas2'>";
							$i=1;
							}else{
							echo "<TR BGCOLOR='#FFFFCC' class='filas2'>";
							$i=0;
							}
							?>
								<td class='filas2'><?php echo $reg["ID"];?> &nbsp;</td>
								<td class='filas2'>
									<?php 
										$art=mysql_query("SELECT Id, articulo, referencia FROM inventario where id='$reg[0]';");
										while($articulo=mysql_fetch_array($art)){
										echo $articulo[1]." - ".$articulo[2];
										}
									?> &nbsp;
								</td>
								<td class='filas2' align='center' ><?php echo $reg[1];?> &nbsp;</td>
								<td class='filas2' align='right'><?php echo $reg["VALOR_UNITARIO"];?> &nbsp;</td>
								<td class='filas2' align='right'><?php echo $reg[3];?> &nbsp;</td>
								<td class='filas2' align='center'><?php echo $reg["FECHA"];?> &nbsp;</td>
								<td class='filas2' align='center'><?php echo $reg["FACTURA"];?> &nbsp;</td>
							</tr>
							<?php } ?>
						</TD>
					</TR>
					</table>
					</center>
					</td>
				</tr>
			</table>
		</td>
		
		<!--<td width="77" background="rightbg.jpg" height="100%"><img src="rightbg.jpg" width="77" height="22" border="0" alt=""></td> !-->
	</tr>
</table>


</body>
</html>


