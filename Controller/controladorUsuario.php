<?php
require_once("ConexionDB.php");
require_once("../Model/personas.php");
require_once("../Model/usuarios.php");
require_once("../Model/crudUsuarios.php");

class controladorUsuario
{
    public function __construct(){}

    public function listarUsuarios()
    {
        $crudUsuarios = new crudUsuarios(); //Invocamos el objeto
        return $crudUsuarios->listarUsuarios(); //Retornamos la lista de clientes
    }

    public function listarRoles()
    {
        $crudUsuarios = new crudUsuarios(); //Invocamos el objeto
        return $crudUsuarios->listarRoles(); //Retornamos la lista de clientes
    }

    public function registrarUsuario($nombre, $apellido, $correo, $cedula, $telefono, $direccion, $estado, $idRol, $nombreUsuario, $contrasena)
    {
        $usuario = new usuarios(); //Instanciamos el objeto
        $usuario->setUsuario($nombreUsuario); //Setter a cada atributo recibido
        $usuario->setContrasena($contrasena);
        $usuario->setIdRol($idRol);
        $usuario->setEstado($estado);

        $persona = new personas();
        $persona->setNombre($nombre);
        $persona->setApellido($apellido);
        $persona->setCorreo($correo);
        $persona->setCedula($cedula);
        $persona->setTelefono($telefono);
        $persona->setDireccion($direccion);
        $crudUsuario = new crudUsuarios(); //Creamos el objeto del modelo para el registro
        return $crudUsuario->registrarUsuario($usuario, $persona); //Enviamos el objeto al modelo
    }

    public function buscarUsuario($idUsuario)
    {
        $crudUsuario = new crudUsuarios();
        return $crudUsuario->buscarUsuario($idUsuario);
    }

    public function editarUsuario($idPersona, $nombre, $apellido, $correo, $cedula, $telefono, $direccion, $estado, $idRol, $nombreUsuario)
    {
        $usuario = new usuarios(); //Instanciamos el objeto
        $usuario->setUsuario($nombreUsuario);
        $usuario->setIdRol($idRol);
        $usuario->setEstado($estado);

        $persona = new personas();
        $persona->setNombre($nombre);
        $persona->setApellido($apellido);
        $persona->setCorreo($correo);
        $persona->setCedula($cedula);
        $persona->setTelefono($telefono);
        $persona->setDireccion($direccion);
        $crudUsuario = new crudUsuarios(); //Creamos el objeto del modelo para el registro
        return $crudUsuario->editarUsuario($usuario, $persona, $idPersona); //Enviamos el objeto al modelo
    }
    /*
    public function EliminarClientes($Documento){
        $CrudClientes = new CrudClientes();
        return $CrudClientes->EliminarClientes($Documento);
    } */
}

$controladorUsuario = new controladorUsuario();
    if (isset($_GET['registrarUsuario'])) {
        header('Location:../View/crearUsuario.php');
    }
    if (isset($_GET['listarUsuarios'])) {
        header('Location:../View/listarUsuarios.php');
    }
    if (isset($_POST['registrarUsuario'])) {
        if($_POST['contrasena'] !== $_POST['confirmarContrasena']){
            header('Location:../View/crearUsuario.php?error=Las-contraseñas-no-coinciden.');
        }else if(trim($_POST['nombre']) == '' || trim($_POST['apellido']) == '' || trim($_POST['correo']) == '' || trim($_POST['cedula']) == '' || trim($_POST['telefono']) == '' || trim($_POST['estado']) == '' || trim($_POST['idRol']) == '' && trim($_POST['usuario']) == '' || trim($_POST['contrasena']) == '' || trim($_POST['direccion'] == '')){
            header('Location:../View/crearUsuario.php?error=Ocurrio-un-error,-alguno-de-los-campos-no-se-completo.');
        }   
        $respuesta = $controladorUsuario->registrarUsuario($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['cedula'], $_POST['telefono'], $_POST['direccion'], $_POST['estado'], $_POST['idRol'], $_POST['usuario'], $_POST['contrasena']);
        if($respuesta == "Se creo con éxito"){
            header('Location:../View/listarUsuarios.php');
        }else{
            header('Location:../View/crearUsuario.php?error='.$respuesta);
        }
    }
    if (isset($_GET['editarUsuario'])) {
        header('Location:../View/editarUsuario.php?idUsuario='.$_GET['editarUsuario']);
    }
    if (isset($_POST['editarUsuario'])) {
        if(trim($_POST['nombre']) == '' || trim($_POST['apellido']) == '' || trim($_POST['correo']) == '' || trim($_POST['cedula']) == '' || trim($_POST['telefono']) == '' || trim($_POST['estado']) == '' || trim($_POST['idRol']) == '' && trim($_POST['usuario']) == '' || trim($_POST['direccion'] == '')){
            header('Location:../View/editarUsuario.php?error=Ocurrio-un-error,-alguno-de-los-campos-no-se-completo.');
        }   
        $respuesta = $controladorUsuario->editarUsuario($_POST['idPersona'], $_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['cedula'], $_POST['telefono'], $_POST['direccion'], $_POST['estado'], $_POST['idRol'], $_POST['usuario']);
        // var_dump($respuesta);
        if($respuesta == "Editado con éxito"){
            header('Location:../View/listarUsuarios.php');
        }else{
            header('Location:../View/editarUsuario.php?error='.$respuesta);
        }    
    }
// if (isset($_POST['EliminarCliente'])) {
//     echo $ControladorClientes->EliminarClientes($_POST['Documento']);
// }
?>