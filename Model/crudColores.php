<?php
    class crudColores{
        public function __construct(){}

        public function listarColores(){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->query('SELECT * FROM colores');//Consultamos la base de datos
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            return $sql->fetchAll();//Retornamos toda la informacion
        }

        public function registrarColor($color){
            $mensaje = '';
            $Db = ConexionDB::Conectar();
            $sql = $Db->prepare('INSERT INTO colores(nombre)
            VALUES (:nombre)');
            $sql->bindvalue('nombre',$color->getNombre());
            try {
                $sql->execute(); //Ejecutamos la consulta
                $mensaje = "Se creo con éxito";
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($Db); //Cerramos conexion a la DB
            return $mensaje;
        }

        public function buscarColor($idColor){
            $Db = ConexionDB::Conectar(); //Establecemos conexion
            $sql = $Db->prepare('SELECT * FROM colores WHERE idColor=:idColor'); //Preparamamos el query
            $sql->bindvalue('idColor',$idColor); //Asignamos el valor documento
            $sql->execute();//Ejecutamos la consulta
            return $sql->fetch(); //Retornamos una linea
        }
        
        public function editarColor($color, $idColor){
            $db = ConexionDB::Conectar(); //Conectamos la base de datos
            $sql = $db->prepare('UPDATE colores SET
            nombre=:nombre
            WHERE idColor=:idColor');
            $sql->bindValue('nombre', $color->getNombre());
            $sql->bindValue('idColor', $idColor);
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