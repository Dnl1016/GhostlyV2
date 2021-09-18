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

    public function registrarEntradas($cantidad, $idDetalleProducto){
        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d h:m:s');
        $crudEntradas = new crudEntradas();
        return $crudEntradas->registrarEntradas($cantidad, $idDetalleProducto, $fecha);
    }
}
$controladorEntradas = new controladorEntradas();

if(isset($_GET['listarEntradas']))
    header('Location: ../View/listarEntradas.php');
else{
    if(isset($_GET['registrarEntradas']))
        header('Location: ../View/crearEntradas.php');
    else{
        if(isset($_POST['registrarEntradas'])){
            if(count($_POST['cantidad']) > 0 && count($_POST['idDetalleProducto']) > 0){
                $mensaje = $controladorEntradas->registrarEntradas($_POST['cantidad'], $_POST['idDetalleProducto']);
                var_dump($mensaje);
                if($mensaje == "Entradas registradas")
                    header('Location: ../View/listarEntradas.php');
                else
                    header('Location: ../View/crearEntradas.php?error='.$mensaje);
            }else{
                header('Location: ../View/crearEntradas.php?error=Datos-incompletos,-intente-de-nuevo');
            }
        }
    }
}
?>