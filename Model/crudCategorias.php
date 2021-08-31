<?php
    class crudCategorias{
        public function __construct(){}

        public function listarCategorias(){
            $db = ConexionDB::Conectar(); //Conectamos con la base de datos
            $sql = $db->query('SELECT * FROM categorias');//Consultamos la base de datos
            $sql->execute();
            ConexionDB::CerrarConexion($Db);
            return $sql->fetchAll();//Retornamos toda la informacion
        }

        public function registrarCategoria($categoria){
            $mensaje = '';
            $Db = ConexionDB::Conectar();
            $sql = $Db->prepare('INSERT INTO categorias(nombre, estado)
            VALUES (:usuario, :estado)');
            $sql->bindvalue('usuario',$categoria->getNombre());
            $sql->bindvalue('estado',$categoria->getEstado());
            try {
                $sql->execute(); //Ejecutamos la consulta
                $mensaje = "Se creo con éxito";
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            ConexionDB::CerrarConexion($Db); //Cerramos conexion a la DB
            return $mensaje;
        }

        public function buscarCategoria($idCategoria){
            $Db = ConexionDB::Conectar(); //Establecemos conexion
            $sql = $Db->prepare('SELECT * FROM categorias WHERE idCategoria=:idCategoria'); //Preparamamos el query
            $sql->bindvalue('idCategoria',$idCategoria); //Asignamos el valor documento
            $sql->execute();//Ejecutamos la consulta
            return $sql->fetch(); //Retornamos una linea
        }
        
        public function editarCategoria($categoria, $idCategoria){
            $db = ConexionDB::Conectar(); //Conectamos la base de datos
            $sql = $db->prepare('UPDATE categorias SET
            nombre=:nombre,
            estado=:estado
            WHERE idCategoria=:idCategoria');
            $sql->bindValue('nombre', $categoria->getNombre());
            $sql->bindValue('estado', $categoria->getEstado());
            $sql->bindValue('idCategoria', $idCategoria);
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