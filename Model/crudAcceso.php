<?php
class crudAcceso{
    public function __construct(){}

    public function validarAcceso($usuario){
        $db = ConexionDB::Conectar(); //Establecer la conexion a la DB
        $sql = $db->prepare('SELECT * FROM usuarios
        WHERE usuario=:usuario AND contrasena=:contrasena
        AND estado=1');  /*Establecemos el query selector, que nos retornara 
        los datos de la DB, para validar el usuario*/
        $sql->bindvalue('usuario',$usuario->getUsuario());
        $sql->bindvalue('contrasena',sha1($usuario->getContrasena()));
        try {
            $sql->execute();
            $usuario->setEstado(0);
            if($sql->rowCount() > 0){
                $datosUsuarios = $sql->fetch(); // Retornamos los datos de la consulta
                $usuario->setEstado(1); // Asignamos el estado del usuario
                $usuario->setRol($datosUsuarios['idRol']); // Asignamos el rol al usuario
                $usuario->setContrasena('');
            }
        }catch(Exception $e) {
            return $e->getMessage();
        }
        return $usuario;
    }
}
?>