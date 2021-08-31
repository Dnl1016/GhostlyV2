<?php 
 
 class ConexionDB{
     private static $Conexion=NULL;
     public function __construct(){}
     
     public static function Conectar(){
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         self::$Conexion = new PDO('mysql:host=localhost;dbname=ghostly', 'root', '', $pdo_options);
         return self::$Conexion;
     }

     public static function CerrarConexion(&$Conexion){
         return $Conexion=NULL; 
    }
 }
 $ConexionDB=ConexionDB::Conectar();
?>