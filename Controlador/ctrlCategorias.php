<?php
    require('../Modelo/categorias.php');
    
    $accion = "";
    if(isset($_POST['accion'])){
        $accion = $_POST['accion'];
    }
    
    if($accion=='Buscar'){
        $idNegocio=$_POST['idneg'];
       $cat= new Categoria();
        $cat->buscar($idNegocio);
    }
    
    if($accion=='Agregar'){
        $idNegocio=$_POST['idneg'];
        $nombre=$_POST['nombreCategoria'];
        $cat= new Categoria();
        $cat->agregar($idNegocio,$nombre);
        $cat->buscar($idNegocio);
    }

    if($accion=='Eliminar'){
        $idNegocio=$_POST['idneg'];
        $id=$_POST['idCategoria'];
        $cat= new Categoria();
        $cat->eliminar($idNegocio,$id);
        $cat->buscar($idNegocio);
    }

    if($accion=='actualizar'){
        $idNegocio=$_POST['idNeg'];
        $campo=$_POST['campo'];
        $clave=$_POST['clave'];
        $valor=$_POST['valor'];
        $cat= new Categoria();
        $cat->actualizar($idNegocio,$campo,$clave,$valor);
        $cat->buscar($idNegocio);        
    }
    
    if($accion=='AgregarCategoriaArticuloNuevo'){
        $idNegocio=$_POST['idneg'];
        $nombre=$_POST['nombreCategoria'];
        $cat= new Categoria();
        $cat->agregarDirecta($idNegocio,$nombre);       
    }


?>