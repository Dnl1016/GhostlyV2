<?php
    class roles{
        private $nombre;
        private $estado;

        public function __construct(){}

        public function setNombre($nombre){
            $this->nombre=$nombre;
        }

        public function setEstado($estado){
            $this->estado=$estado;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getEstado(){
            return $this->estado;
        }
    }
?>