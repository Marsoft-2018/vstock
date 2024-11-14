<?php
    include("header.php");
    require('../Modelo/category.php');
    
    
    // if($accion=='AgregarCategoryArticuloNuevo'){
    //     $idNegocio=$_POST['idneg'];
    //     $nombre=$_POST['nombreCategory'];
    //     $cat= new Category();
    //     $cat->agregarDirecta($idNegocio,$nombre);       
    // }

   
    switch ($accion) {
        case 'add':
            add_or_set_category($accion);           
            break;
        case 'edit':
            $objCategory = new Category();
            $objCategory->bussines_id = $data['bussines_id'];
            $objCategory->id = $data['id'];
            include("../Vistas/categories/formulario.php");  
            
            break;
        case 'update':
            add_or_set_category($accion);        
            break;
        case 'delete':
            $objCategory = new Category();
            $objCategory->id = $data['id'];
            $objCategory->delete();         
            break;
        case 'new':
            include("../Vistas/categories/formulario.php");     
            break;
        case 'load':
            $objCategory = new Category();
            $objCategory->bussines_id = $data['bussines_id'];
            $objCategory->id = $data['id'];
            include("../Vistas/categories/index.php");     
            break;
        case 'list':
            $objCategory = new Category();
            $objCategory->bussines_id = $data['bussines_id'];
            include("../Vistas/categories/index.php");     
            break;
    }

    function add_or_set_category($tipo){
        $objCategory= new Category();
        $objCategory->bussines_id =$_POST['bussines_id'];
        $objCategory->name = $_POST['name'];
        $objCategory->description = $_POST['description'];
        switch ($tipo) {
            case 'add':
                $objCategory->add();
                break;
            case 'update':
                $objCategory->id = $_POST['id'];
                $objCategory->update();          
                break;
        }
    }
?>