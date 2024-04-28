<html>

<head>
    <title></title>
    <script LANGUAGE="JavaScript">
    <!--
    if (top == self) self.location.href = "http://localhost/cuentas/";
    // 
    -->
    </script>
    <script language=javascript>
    function Relleno() {
        var datos = new Array();
        var a;
        datos = document.compras_modulo.articulo.value.split("�");
        document.compras_modulo.ID.value = datos[0];
        document.compras_modulo.articulo1.value = datos[1];
        document.compras_modulo.ref.value = datos[2];
        document.compras_modulo.Pre_compra.value = datos[3];
        document.compras_modulo.Pre_venta.value = datos[4];
        document.compras_modulo.CANTIDAD2.value = datos[6];
        document.compras_modulo.Cant_final.value = datos[9];
        document.compras_modulo.V_UNIT.value = document.compras_modulo.Pre_compra.value;
        a = datos[9];
        parseInt(a);
        if (a < 5) {
            window.alert("La cantidad de existencias de este articulo esta llegando a un nivel m�nimo");
        }
    }

    function valorunitario() {
        document.compras_modulo.V_UNIT.value = parseInt(document.compras_modulo.Pre_compra.value);
    }

    function multiplica() {
        var a = parseInt(document.compras_modulo.V_UNIT.value);
        var b = parseInt(document.compras_modulo.CANTIDAD.value);
        var cant2 = parseInt(document.compras_modulo.CANTIDAD2.value);
        var c_final = parseInt(document.compras_modulo.Cant_final.value);
        var P_VENTA = parseInt(document.compras_modulo.Pre_venta.value);
        var P_COMPRA = parseInt(document.compras_modulo.Pre_compra.value);
        var vtotal;
        document.compras_modulo.Cant_final.value = (c_final + b);
        if (c_final = 0) {
            document.compras_modulo.CANTIDAD.value = 0;
        } else {
            vtotal = (a * b);
            document.compras_modulo.V_TOTAL.value = -(parseInt(vtotal));
            document.compras_modulo.CANTIDAD2.value = (cant2 + b);
            document.compras_modulo.GANANCIA.value = (P_COMPRA - P_VENTA) * b;
        }
    }

    function salir() {
        self.location.href = "http://localhost/cuentas/BLANK.HTML";
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
    <style type="text/css">
    <!--
    .color {
        background-color: #FF0000;
        margin: 2px;
        height: 20px;
        width: 100px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-weight: bold;
    }
    -->
    </style>
    <SCRIPT LANGUAGE="JavaScript">
    <!-- Hiding from other browsers
    // Browser Detector (v. 1.0)
    // Author: Jason Tschopp
    // Email: tschopp@greenapple.com
    // Url: http://www.greenapple.com/~tschopp/
    // Notes: Permission is granted to anyone for use 
    // on the internet, provided this header stays with 
    // the script and this header stays in intact.

    // 
    -->
    </SCRIPT>
</head>
<? include('estiloscss/estilo1.css'); ?>

<body oncontextmenu="return false" bottommargin="0" leftmargin="0" marginheiht="0" marginwidth="0" rightmargin="0"
    topmargin="0" bgcolor=#0066CC>
    <table width="100%" cellpadding="0" cellspacing="0" border="2" height="10">
        <TR bgColor=#000000>
            <TD HEIGHT="10" align=middle width=87%>
                <font color="#FFFFFF">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����������||| MODULO DE COMPRAS |||�����������
                </FONT>
            </TD>
            <TD HEIGHT="10" align=middle bgcolor="#99FF00">Control Contable �</TD>
        </TR>
    </table>
    <FORM METHOD='POST' Name='compras_modulo' ACTION='compras.PHP'>
        <table width="100%" cellpadding="5" cellspacing="0" border="0" height="100%">
            <center>
                <tr valign="top">
                    <td width="100%">
                        <table width="100%" cellpadding="8" cellspacing="0" border="0">
                            <tr valign="top">
                                <TD width="69%" align="center">
                                    <table name=tabla1 border='2' cellpadding="3" width="65%"
                                        BACKGROUND="TOOLS/FND1.bmp">
                                        <tr>
                                            <td colspan=4 bgcolor=#407BC2 ALIGN=center>
                                                <div CLASS=POS><img name='icono' alt='' src='tools/COMPRA.png'
                                                        height='30px' width='30px'></div>
                                                <div><b>
                                                        <font color=#FFFFFF>DATOS DE LA COMPRA</font>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#99CCFF">
                                                <!-----------CONSULTA PARA EL INVENTARIO.-------------------------------------------->
                                                <?
							require("conect.php");
							$sqlinst="select * from inventario order by id";
							$resultinst=mysql_query($sqlinst,$conexion) or die ("No trajo sede");
							
							echo "Elija el articulo a comprar: <br> ". 
							"<select name='articulo' class='combo' onchange='Relleno()'>";
							echo "<option value='"." "."�"." "."�"." "."�"." "."�"." "."�"." "."�"." "."�"." "."�"." "."�"." "."'></option>";
							while ($row=mysql_fetch_array($resultinst)){
							echo "<option value='".$row[0]."�".$row[1]."�".$row[2]."�".$row[3]."�".$row[4]."�".$row[5]."�".$row[6]."�".$row[7]."�".$row[8]."�".$row[9]."'>".$row[0]." - ".$row[1]." - ".$row[2]."</option>";
							}
							echo "</select>";
						?>
                                            </td>
                                            <td align='center' bgcolor='white'>
                                                <div><img name='logotipo' alt='Logo' src='tools/logo.jpg' height='100px'
                                                        width='200px'></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'>
                                                <table border='0' CELLPADDING=0 cellspacing=0
                                                    style='BORDER-COLLAPSE: collapse' width="80%">
                                                    <tr>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td class='filas1'>C�digo:</td>
                                                                    <td class='filas1'>Articulo:</td>
                                                                    <td class='filas1'>Referencia:</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class='filas1'><input type=text class='claseid'
                                                                            maxlength=10 name='ID' align='right'
                                                                            bgcolor='red'></td>
                                                                    <td class='filas1'><input type=text class='clase21'
                                                                            name='articulo1' align='center'></td>
                                                                    <td class='filas1'><input type=text class='clase3'
                                                                            name='ref' align='center'></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td rowspan='4' colspan=3>
                                                            &nbsp;&nbsp;<INPUT TYPE=SUBMIT NAME='accion'
                                                                value="Ingresar Compra" class='botones'><br>
                                                            &nbsp;&nbsp;<INPUT TYPE=reset VALUE="Limpiar Formulario"
                                                                CLASS='botones'><br>
                                                            &nbsp;&nbsp;<INPUT TYPE=button VALUE="Salir" CLASS='botones'
                                                                onclick='salir()'>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td class='filas1'>Existencias</td>
                                                                    <td class='filas1'>Precio de Compra:</td>
                                                                    <td class='filas1'>Precio de Venta:</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class='filas1'><input type=text class='clase31'
                                                                            name='Cant_final' align='rigth' size=10>
                                                                    </td>
                                                                    <td class='filas1'><input type=text class='clase3'
                                                                            name='Pre_compra' align='right' size=15
                                                                            onblur='valorunitario()'></td>
                                                                    <td class='filas1'><input type=text class='clase3'
                                                                            name='Pre_venta' align='rigth' size=15></td>

                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <input type='hidden' name='GANANCIA' align='rigth' size=10>
                                                    </tr>
                                                    <tr>
                                                        <table>
                                                            <tr>
                                                                <td class='filas1'>Cantidad:&nbsp;</td>
                                                                <td class='filas1'>Valor Unitario:&nbsp;</td>
                                                                <td class='filas1'>Valor Total:&nbsp;</td>
                                                                <td class='filas1'>Fecha:&nbsp;&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='filas1'><input type=text class='clase31'
                                                                        name='CANTIDAD' size=8 onblur='multiplica()'>
                                                                </td>
                                                                <td class='filas1' align='center'><input type=text
                                                                        class='clase3' name='V_UNIT' size=10></td>
                                                                <td class='filas1'><input type=text class='clase3'
                                                                        name='V_TOTAL' size=10></td>
                                                                <td class='filas1'><input type=text class='clase31'
                                                                        name='FECHA' size=8
                                                                        VALUE='<? print (date("Y-m-d"));?>'></td>
                                                            </tr>
                                                        </table>
                                                    </tr>
                                                    <tr>
                                                        <td class='filas1' colspan=3>
                                                            <Table>
                                                                <tr>
                                                                    <td class='filas1'>Unidades compradas hasta el
                                                                        momento:</td>
                                                                    <td class='filas1'><input type=text class='clase2'
                                                                            name='CANTIDAD2' size=9 value=0></td>
                                                                </tr>
                                                            </Table>
                                                    </tr>
                                                    <tr>
                                                        <?
							switch ($accion) {
							case "Ingresar Compra":
								$modificar="UPDATE INVENTARIO SET COMPRAS='$CANTIDAD2',CANT_FINAL='$Cant_final' where ID='$ID'";
								$resultados=mysql_query($modificar);
								$sql1 = "INSERT INTO Movimientos VALUES('$ID','$CANTIDAD','$V_UNIT','$V_TOTAL','$GANANCIA','Compra','$FECHA')";
								$resultado2 = mysql_query($sql1);
								ECHO "<td colspan='5' bgcolor='white'>Registro agregado de manera satisfactoria debe reiniciar esta ventana para refrescar los datos</td>";
								echo "<META HTTP-EQUIV=Refresh CONTENT='1;URL=COMPRAS.php'>";
							break;
							default:
							}
						?>
                                            </td>
                                        </tr>
                                    </table>
    </form>
    </TD>
    </tr>
    </table>
    </td>
    </tr>
    <center>
        </table>


</body>

</html>