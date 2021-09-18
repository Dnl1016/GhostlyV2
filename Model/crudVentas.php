<?php 
    class crudVentas{

        public function __construct(){}

        public function listarVentas(){
            $db = ConexionDB::Conectar();
            $sql = $db->query("SELECT * FROM ventas");
            $sql->execute();
            return $sql->fetchAll();
        }

        public function listarPersonas(){
            $db = ConexionDB::Conectar();
            $sql = $db->query('SELECT p.idPersona, p.nombre, p.apellido, p.cedula
            FROM usuarios u JOIN personas p ON u.idPersona=p.idPersona WHERE u.estado = 1');
            $sql->execute();
            return $sql->fetchAll();
        }

    }
?>