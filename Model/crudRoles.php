<?php
    class crudroles{
        public function __construct(){}

        public function listarRoles(){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->query('SELECT * FROM roles');//Consultamos la base de datos
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            return $sql->fetchAll();//Retornamos toda la informacion
        }

        public function registrarRoles($Rol){
            $mensaje = '';
            $Db = ConexionDB::Conectar();
            $sql = $Db->prepare('INSERT INTO roles(nombre, estado)
            VALUES (:nombre, :estado)');
            $sql->bindvalue('nombre',$Rol->getNombre());
            $sql->bindvalue('estado',$Rol->getEstado());
            try {
                $sql->execute(); //Ejecutamos la consulta
                $mensaje = "Se creo con éxito";
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($Db); //Cerramos conexion a la DB
            return $mensaje;
        }

        public function buscarRol($idRol){
            $Db = ConexionDB::Conectar(); //Establecemos conexion
            $sql = $Db->prepare('SELECT * FROM roles WHERE idRol=:idRol'); //Preparamamos el query
            $sql->bindvalue('idRol',$idRol); //Asignamos el valor documento
            $sql->execute();//Ejecutamos la consulta
            return $sql->fetch(); //Retornamos una linea
        }
        
        public function editarRol($Rol, $idRol){
            $db = ConexionDB::Conectar(); //Conectamos la base de datos
            $sql = $db->prepare('UPDATE roles SET
            nombre=:nombre,
            estado=:estado
            WHERE idRol=:idRol');
            $sql->bindValue('nombre', $Rol->getNombre());
            $sql->bindValue('estado', $Rol->getEstado());
            $sql->bindValue('idRol', $idRol);
            try{
                $sql->execute();
                $mensaje = "Se edito con éxito";
            }catch(Exception $e){
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($Db);
            return $mensaje;
        }
    }
?>