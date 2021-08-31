<?php
    class tallas{
        private $nombre;

        public function __construct(){}

        public function setNombre($nombre){
            $this->nombre=$nombre;
        }

        public function getNombre(){
            return $this->nombre;
        }
    }
?>