<?php
    class productos{
        private $nombre;
        private $cantidad;
        private $estado;
        private $genero;
        private $fechaRegistro;
        private $idCategoria;

        public function __construct(){}

        public function setNombre($nombre){
            $this->nombre=$nombre;
        }

        public function setCantidad($cantidad){
            $this->cantidad=$cantidad;
        }

        public function setEstado($estado){
            $this->estado=$estado;
        }

        public function setGenero($genero){
            $this->genero=$genero;
        }

        public function setFechaRegistro($fechaRegistro){
            $this->fechaRegistro=$fechaRegistro;
        }

        public function setIdCategoria($idCategoria){
            $this->idCategoria=$idCategoria;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getCantidad(){
            return $this->cantidad;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function getGenero(){
            return $this->genero;
        }

        public function getFechaRegistro(){
            return $this->fechaRegistro;
        }

        public function getIdCategoria(){
            return $this->idCategoria;
        }
    }
?>