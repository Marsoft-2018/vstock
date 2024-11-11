<?php
    include("header.php");
    require('../Modelo/bussines.php');
   
    switch ($accion) {
        case 'add':
            add_or_set_Bussines($accion);           
            break;
        case 'edit':
            $objBussines = new Bussines();
            $objBussines->id = $data->id;
            include("../Vistas/bussines/formulario.php");  
            
            break;
        case 'update':
            add_or_set_Bussines($accion);        
            break;
        case 'delete':
            $objBussines = new Bussines();
            $objBussines->id = $data->id;
            $objBussines->delete();         
            break;
        case 'new':
            include("../Vistas/bussines/formulario.php");     
            break;
        case 'load':
            $objBussines = new Bussines();
            $objBussines->id = $data->id;
            include("../Vistas/bussines/index.php");     
            break;
        case 'list':
            $objBussines = new Bussines();
            include("../Vistas/bussines/index.php");     
            break;
    }

    function add_or_set_Bussines($tipo){
        $objBussines= new Bussines();
        $objBussines->name = $_POST['name'];
        $objBussines->nit = $_POST['nit'];
        $objBussines->address = $_POST['address'];
        $objBussines->town = $_POST['town'];
        $objBussines->city = $_POST['city'];
        $objBussines->tel = $_POST['tel'];
        $objBussines->email = $_POST['email'];
        //$objBussines->logo = $_POST['logo'];
        $objBussines->propietary = $_POST['propietary'];
        switch ($tipo) {
            case 'add':
                $objBussines->add();
                break;
            case 'update':
                $objBussines->id = $_POST['id'];
                $objBussines->update();          
                break;
        }
    }
?>

<?php
/*
    require('../Conexiones/Conect.php');
    require('../Conexiones/bussines.php');
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
        */
?>