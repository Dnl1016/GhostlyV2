<?php
    class crudTallas{
        public function __construct(){}

        public function listarTallas(){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->query('SELECT * FROM tallas');//Consultamos la base de datos
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            return $sql->fetchAll();//Retornamos toda la informacion
        }

        public function registrarTalla($talla){
            $mensaje = '';
            $Db = ConexionDB::Conectar();
            $sql = $Db->prepare('INSERT INTO tallas(nombre)
            VALUES (:nombre)');
            $sql->bindvalue('nombre',$talla->getNombre());
            try {
                $sql->execute(); //Ejecutamos la consulta
                $mensaje = "Se creo con éxito";
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($Db); //Cerramos conexion a la DB
            return $mensaje;
        }

        public function buscarTalla($idTalla){
            $Db = ConexionDB::Conectar(); //Establecemos conexion
            $sql = $Db->prepare('SELECT * FROM tallas WHERE idTalla=:idTalla'); //Preparamamos el query
            $sql->bindvalue('idTalla',$idTalla); //Asignamos el valor documento
            $sql->execute();//Ejecutamos la consulta
            return $sql->fetch(); //Retornamos una linea
        }
        
        public function editarTalla($talla, $idTalla){
            $db = ConexionDB::Conectar(); //Conectamos la base de datos
            $sql = $db->prepare('UPDATE tallas SET
            nombre=:nombre
            WHERE idTalla=:idTalla');
            $sql->bindValue('nombre', $talla->getNombre());
            $sql->bindValue('idTalla', $idTalla);
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