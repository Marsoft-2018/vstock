<! DOCTYPE HTML>
    <html>

    <head>
        <title>Pagina de Inicio</title>
        <link rel='stylesheet' href='estilosCSS/estiloCss3.css' type='text/css' />
        <!---->
        <link rel='stylesheet' href='estilosCSS/jquery-ui.css' type='text/css' />
        <script type="text/jscript" src="js/jquery.js"></script>
        <script type="text/jscript" src="js/jquery-ui.js"></script>
    </head>

    <body oncontextmenu="return false" bgcolor='#333333'>
        <noscript>
            <p>Bienvenido</p>
            <p>La página que estás viendo requiere para su correcto funcionamiento el uso de JavaScript. por favor a
                activarlo.</p>
        </noscript>
        <div id='contenedorE'>
            <form name=formulario method=post action='' onsubmit='validar()' id='login'>
                <table border='0' id='principal' class='ui-widget-content ui-corner-all'
                    style='width:370px; box-shadow: 0px 5px 280px  rgba(255,255,255,1) ;border-radius: 5px 5px 35px 35px; margin:0px auto;top:250px;left:220px;position:absolute;'>
                    <tr>
                        <th align='center' colspan='3'>
                            <h2 class='ui-widget-header ui-corner-all' style='font-size:24px'>Acceso a Usuarios</h2>
                        </th>
                    </tr>
                    <tr>
                        <td align='center' rowspan='3'><img src="tools/USER (9).PNG" width='80' height='90' id='logo2'>
                        </td>
                        <td align='left' height:'20' style='font-size:14px'>
                            <h3>Nombre</h3>
                        </td>
                        <td>
                            <?php
							require_once("Conexiones/conect.php");
                            $sqlUsu=new Usuario();
							$resultuser=$sqlUsu->Buscar(); 							
							echo "<select name='usuarios' required id='usuario' class='ui-widget-header ui-corner-all combo1' style='font-size:14px'>";
							echo "<option></option>";
							while ($row=mysql_fetch_array($resultuser)){
							     echo "<option value='$row[0]'>".$row[0]."</option>";
							}
							echo "</select>&nbsp;";
						?>
                        </td>
                    </tr>
                    <tr>
                        <td align='left'>
                            <h3 style='font-size:14px'>Contraseña</h3>
                        </td>
                        <td>
                            <input id='contrasena' name='contrasena' type='password'
                                class='ui-widget-header ui-corner-all combo1' style='font-size:14px' value=''
                                required>&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <input type="button" Value="&nbsp;&nbsp;Cerrar&nbsp;&nbsp;" onClick="cerrar()" id='BotonC'
                                class='ui-widget-header ui-corner-all' style='font-size:14px'>
                        </td>
                        <td align="center" height="80%">
                            <input type="submit" value="Ingresar" name='boton' id='BotonI'
                                class='ui-widget-header ui-corner-all' style='font-size:14px'>&nbsp;
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <script type="text/javascript">
        $("#BotonI").button();
        $("#BotonC").button();

        function cerrar() {
            close();
        }

        function validar() {
            var usu = document.getElementById('usuario').value;
            var documento = document.getElementById('contrasena').value;
            var formulario = document.getElementById('login');
            //alert ("El Usuario es: "+usu+" el documento es: "+documento);

            if (usu == "" || documento == "") {
                alert("Por favor ingrese los datos completos");
            } else {
                var conexion;
                conexion = new XMLHttpRequest();
                if (window.XMLHttpRequest) {
                    conexion = new XMLHttpRequest();
                } else {
                    conexion = new ActiveXObject("Microsoft.XMLHTTP");
                }
                conexion.onreadystatechange = function() {
                    if (conexion.readyState == 4 && conexion.status == 200) {
                        formulario.action = conexion.responseText;
                    }
                }
                conexion.open("GET", "validar/autenticacion.php?usu=" + usu + "&pass=" + documento, false);
                conexion.send();
                conexion.close;
            }
        }
        </script>
    </body>

    </html>