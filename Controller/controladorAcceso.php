<?php 
require_once('ConexionDB.php');
require_once('../Model/acceso.php');
require_once('../Model/crudAcceso.php');
class controladorAcceso{
    public function __construct(){}
    public function validarAcceso($nombreUsuario, $contrasena){
        $usuario = new acceso(); //Declaramos el objeto para hacer los setter a acceso
        $usuario->setUsuario($nombreUsuario);
        $usuario->setContrasena($contrasena);
        $crudAccceso = new crudAcceso();
        return $crudAccceso->validarAcceso($usuario);
    }
}
$ControladorAcceso = new ControladorAcceso();
if(isset($_POST['validarAcceso'])){
    $usuario = $ControladorAcceso->validarAcceso($_POST['usuario'], $_POST['contrasena']);
    if($usuario->getEstado() == 1){
        session_start(); // Iniciamos la sesion
        $_SESSION['usuario'] = $usuario->getUsuario();
        $_SESSION['idRol']= $usuario->getRol();
        header('Location:../View/index.php');
    }else{
        header('Location:../View/login.php');
    }
}

if(isset($_POST['cerrarSesion'])){
    session_start();
    session_destroy();
    header('Location:../View/login.php');
}

?>