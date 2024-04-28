<?php
    require('../Conexiones/Conect.php');

    class Categoria extends Conectar{
        function buscar($idNegocio){
            $sql = mysql_query("SELECT * FROM categorias WHERE idNegocio='$idNegocio';");
            
            echo "<h2 style='text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);'>MODULO CONFIGURACION DE LAS  CATEGORIAS</h2>";
            echo "<div id='Contenedor' class='container'>";     
                echo "<div class='panel panel-info clase3'>";
                    echo "<div class='panel-heading clase3'>";
                        echo "<h4>CATEGORIAS REGISTRADAS</h4>";
                    echo "</div>";
                    echo "<div class='panel-body clase3' id='vacciones'>";
                    echo "<div class='alert alert-dimissable alert-warning'>";
                    echo    "Señor usuario tenga en cuenta esta advertencia cuado desee eliminar una de las categorias registradas; verifique que no existan articulos relacionados con la categoría ya que estos también se eliminarán una vez confirme el procedimiento.";
                    echo "</div>";                         
                    echo    "<table class='table '>";
                    while($ct=mysql_fetch_array($sql)){
                        echo "<tr>";                
                            echo "<td style='width:100px'> "; 
                            echo    "<input type='text' value='$ct[1]' id='$ct[1]' class='form form-control' readonly='true'>";
                            echo "</td>";
                            echo "<td>";
                            echo    "<input type='text' value='$ct[2]' id='$ct[1]' name='Categorias' class='form form-control' onchange='actualizarCategoria(this.name,this.id,this.value)'>";
                            echo "</td>";
                            echo "<td>";
                            echo    "<button class='btn btn-danger' id='$ct[1]' title='id= $ct[1]' onclick='eliminarCategoria(this.id)'><i class='fa fa-trash' > </i> Eliminar</button>";
                            echo "</td>";
                        echo "<tr>";                        
                    }   
                    echo "<tr>";                
                            
                            echo "<td colspan='2'>";
                            echo    "<input type='text' value='' id='nombreCategoriaNuevo' class='form form-control' placeholder='Ingrese aquí el nombre de la nueva categoria'>";
                            echo "</td>";
                            echo "<td>";
                            echo    "<button class='btn btn-primary' id='agregar' onclick='agregarCategoria()'><i class='fa fa-plus'> </i> Agregar</button>";
                            echo "</td>";
                    echo "<tr>";
                        echo "</table>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            echo "</div>";
  
        } 
        function agregar($idNegocio,$nombre){
            mysql_query("INSERT INTO categorias(idNegocio,Categorias) VALUES('$idNegocio','$nombre')");
        }
        function eliminar($idNegocio,$id){            
            try {
                mysql_query("DELETE FROM `categorias` WHERE `Id_categoria` = '$id';");
            } catch (Exception $e) {
                echo 'Error al eliminar: ',  $e->getMessage(), "\n";
            }
        }
        function actualizar($idNeg,$campo,$clave,$valor){
            mysql_query("UPDATE categorias SET `$campo`='$valor' WHERE `Id_categoria`='$clave' AND `idNegocio`='$idNeg';");
            echo   "<script type='text/javascript'> alertify.success('Actualizado con éxito'); </script>";
        }
        function agregarDirecta($idNegocio,$nombre){
            mysql_query("INSERT INTO categorias(idNegocio,Categorias) VALUES('$idNegocio','$nombre')");
            echo "<input type='text' id='categoriaNuevoArticulo'  value='' class='form-control' list='listaCategoriasExistentes'>";
            echo   "<span class='input-group-btn'>
                        <buttton class ='btn btn-primary' onclick='agregarCategoriaDirecta()' title='Agregar la categoria al listado'>
                            <i class='fa fa-plus'></i>
                        </button>
                    </span>";
            echo "<datalist id='listaCategoriasExistentes'>";
            
            $sqlCategorias=mysql_query("select * from categorias");
            while ($cat=mysql_fetch_array($sqlCategorias)){
                echo "<option value='$cat[1]'>$cat[2]";
            }
            echo "</datalist>";
             echo "<script> alertify.success('La categoria: $nombre ya esta en lista'); </script>";
        }
    }

?>