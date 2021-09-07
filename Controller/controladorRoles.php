<?php
require_once("ConexionDB.php");
require_once("../Model/roles.php");
require_once("../Model/crudRoles.php");

class controladorRoles
{
    public function __construct(){}

    public function listarRoles()
    {
        $crudRoles = new crudRoles(); //Invocamos el objeto
        return $crudRoles->listarRoles(); //Retornamos la lista de clientes
    }

    public function registrarRoles($nombre)
    {
        $Rol = new Roles();
        $Rol->setNombre($nombre);
        $Rol->setEstado(1);
        $crudRoles = new crudRoles(); //Creamos el objeto del modelo para el registro
        return $crudRoles->registrarRoles($Rol); //Enviamos el objeto al modelo
    }

    public function buscarRol($idRol)
    {
        $crudRoles = new crudRoles();
        return $crudRoles->buscarRol($idRol);
    }

    public function editarRol($nombre, $idRol, $estado)
    {
        $Rol = new Roles();
        $Rol->setNombre($nombre);
        $Rol->setEstado($estado);

        $crudRoles = new crudRoles();
        return $crudRoles->editarRol($Rol, $idRol);
    }
}

$controladorRol = new controladorRoles();
    if (isset($_GET['registrarRoles'])) {
        header('Location:../View/crearRol.php');
    }
    if (isset($_GET['listarRoles'])) {
        header('Location:../View/listarRoles.php');
    }
    if (isset($_POST['registrarRoles'])) {
        if(trim($_POST['nombre']) == ''){
            header('Location:../View/crearRol.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
        }   
        $respuesta = $controladorRol->registrarRoles($_POST['nombre']);
        if($respuesta == "Se creo con éxito"){
            header('Location:../View/listarRoles.php');
        }else{
            header('Location:../View/crearRol.php?error='.$respuesta);
        }
    }
    if (isset($_GET['editarRol'])) {
        header('Location:../View/editarRol.php?idRol='.$_GET['editarRol']);
    }
    if (isset($_POST['editarRol'])) {
        if(trim($_POST['nombre']) == ''){
            header('Location:../View/editarRol.php?error=Ocurrio-un-error,-el-nombre-no-se-ingreso.');
        }   
        $respuesta = $controladorRol->editarRol($_POST['nombre'], $_POST['idRol'], $_POST['estado']);
        if($respuesta == "Se edito con éxito"){
            header('Location:../View/listarRoles.php');
        }else{
            header('Location:../View/editarRol.php?error='.$respuesta);
        }   
    }
?>