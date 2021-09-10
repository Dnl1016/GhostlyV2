<?php 
require_once("ConexionDB.php");
require_once("../Model/crudEntradas.php");

class controladorEntradas{
    
    public function __construct(){}

    public function listarEntradas(){
        $crudEntradas = new crudEntradas();
        return $crudEntradas->listarEntradas();
    }

    public function listarDetalleProductos(){
        $crudEntradas = new crudEntradas();
        return $crudEntradas->listarDetalleProductos();
    }
}
$controladorEntradas = new controladorEntradas();

if(isset($_GET['listarEntradas']))
    header('Location: ../View/listarEntradas.php');
else{
    if(isset($_GET['registrarEntradas'])){
        header('Location: ../View/crearEntradas.php');
    }
}
?>