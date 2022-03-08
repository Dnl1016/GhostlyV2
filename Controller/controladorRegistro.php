<?php
require_once("ConexionDB.php");
require_once("../Model/personas.php");
require_once("../Model/usuarios.php");
require_once("../Model/crudRegistrar.php");

class controladorRegistro
{
    public function __construct(){}

    public function registrarUsuario($nombre, $apellido, $correo, $cedula, $telefono, $direccion, 
     $usuario, $contrasena)
    {
        $usuarios = new usuarios(); //Instanciamos el objeto
        $usuarios->setUsuario($usuario); //Setter a cada atributo recibido
        $usuarios->setContrasena($contrasena);
        
    
        $persona = new personas();
        $persona->setNombre($nombre);
        $persona->setApellido($apellido);
        $persona->setCorreo($correo);
        $persona->setCedula($cedula);
        $persona->setTelefono($telefono);
        $persona->setDireccion($direccion);
        $crudRegistrar = new crudRegistrar(); //Creamos el objeto del modelo para el registro
        return $crudRegistrar->registrarUsuario($usuarios, $persona); //Enviamos el objeto al modelo
    }
}

$controladorRegistro = new controladorRegistro();
    if (isset($_GET['registrarUsuario'])) {
        header('Location:../View/registrar.php');
    }
    if (isset($_POST['registrarUsuario'])) {
        if($_POST['contrasena'] !== $_POST['confirmarContrasena']){
            header('Location:../View/registrar.php?error=Las-contraseñas-no-coinciden.');
        }else if(trim($_POST['nombre']) == '' || trim($_POST['apellido']) == '' || trim($_POST['correo']) == '' || trim($_POST['cedula']) == '' || trim($_POST['telefono']) == ''  && trim($_POST['usuario']) == '' || trim($_POST['contrasena']) == '' || trim($_POST['direccion'] == '')){
            header('Location:../View/registrar.php?error=Ocurrio-un-error,-alguno-de-los-campos-no-se-completo.');
        }   
        $respuesta = $controladorRegistro->registrarUsuario($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['cedula'], $_POST['telefono'], $_POST['direccion'],  $_POST['usuario'], $_POST['contrasena']);
        if($respuesta == "Se creo con éxito"){
            header('Location:../View/home.php');
        }else{
            header('Location:../View/registrar.php?error='.$respuesta);
        }
    }

?>