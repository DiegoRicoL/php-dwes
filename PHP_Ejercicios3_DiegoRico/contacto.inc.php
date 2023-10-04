<?php

    class Contacto {
        private static $cuentaContactos = 0;

        private $idContacto = 0;

        private $nombre;
        private $apellido1;
        private $apellido2;
        private $telefono;

        public function __construct($nombre, $apellido1, $apellido2, $telefono){
            self::$cuentaContactos++;
            $this->idContacto = self::$cuentaContactos;
            $this->nombre = $nombre;
            $this->apellido1 = $apellido1;
            $this->apellido2 = $apellido2;
            $this->telefono = $telefono;
        }

        public function __set($propiedad, $valor){
            $this->$propiedad = $valor;
        }

        public function __get($propiedad){
            return $this->$propiedad;
        }

        public function __toString(){
            return 'Id Contacto: '. $this->idContacto . '<br>Nombre completo: ' . $this->nombre . ' ' . $this->apellido1 . ' ' . $this->apellido2 . '<br>Telefono asociado: ' . $this->telefono;
        }
    }

?>