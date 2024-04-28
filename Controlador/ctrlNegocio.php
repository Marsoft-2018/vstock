<?php
    require('../Conexiones/Conect.php');
    require('../Conexiones/Negocio.php');
    $accion=$_POST['accion'];
    
    if($accion=='modificarDato'){        
        $campo=$_POST['campo'];
        $clave=$_POST['clave'];
        $valor=$_POST['valor'];
        //echo "esta en las acciones de la tabla administrar y se reciben la variables<br>Campo: $campo<br>Clave: $clave<br>Valor: $valor";
        $Neg=new Negocio();
        $Neg->modificarDato($clave,$campo,$valor);               
    }

    if($accion=='cambiarLogo'){ 
        $idNegocio = $_POST['idNegocio'];
        $fotoAnterior = $_POST['fotoAnterior'];
        if ($_FILES["LogoNegocio"]["error"] > 0){
            echo "ha ocurrido un error, al cargar la imagen";
        }

        if(isset($_FILES['LogoNegocio'])){
            $archivo = $_FILES['LogoNegocio'];
            $nombreIMG=$archivo["name"];
            $tipo=$archivo["type"];
            $nombreTemp=$archivo["tmp_name"];
            $tamanho=$archivo["size"];
            $destino="../img/";
            
            $objNeg=new Negocio();                   
            $objNeg->cambiarLogo($idNegocio,$fotoAnterior,$archivo,$nombreIMG,$tipo,$nombreTemp,$tamanho,$destino);             
            
        }else{
            echo '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    No se pudo recibir el archivo con la imágen en el Controlador.
                </div>';
        }
    } 
?>