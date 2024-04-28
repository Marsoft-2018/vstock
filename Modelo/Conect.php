<?php
    abstract class ConectarPDO{
        
        //#####++     Conexiones  hosting locales ++####
        //----------------------------------------------------
    /*
        private $host = "localhost";
        private $bdt = "innovos1_innovo"; //base de datos real    
        //private $bdt = "innovos1_pruebas";
        private $usuario= "innovos1_titan";
        private $password = "EA%JQ=+GTcIA";
    */    
        //-------| Conexion localhost 127.0.0.1 pruebas locales |-----
   
        private $host = "localhost";
        private $bdt = "bdt_vstock";
        private $usuario= "root";
        private $password = ""; //password xampp
        //private $password = "password"; //password para linux
    /*  */

        private $link;
        protected $Conexion;
        public function __construct(){
            $this->link  = "mysql:host=".$this->host;
            $this->link .= ";dbname=".$this->bdt;
            try{
                $this->Conexion = new PDO($this->link, $this->usuario, $this->password, array(
                    PDO::ATTR_PERSISTENT => true
                ));
                $this->Conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $this->Conexion->query("SET NAMES 'utf8';");
            }catch(PDOException $e){
                echo "No hay conexión con la base de datos";
            }
            return $this->Conexion;
        }

        public function cerrarConexion(){
            $this->Conexion = null;
        }
    }
?>