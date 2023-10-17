<?php
    include_once('contacto.inc.php');


    class Agenda {
        private static $contactos;


        public function __construct(){
            self::$contactos = [];
        }

        public function addContact($contacto){
            self::$contactos[] = $contacto;
        }

        public function removeContact($contacto){
            $index = array_search($contacto, self::$contactos);

            unset(self::$contactos[$index]);
        }

        public function __set($propiedad, $valor){
            $this->$propiedad = $valor;
        }

        public function __get($propiedad){
            return $this->$propiedad;
        }

        public function __toString(){
            $string = "";

            foreach(self::$contactos as $contacto){
                $string .= $contacto . '<br>'; 
            }

            return $string;
        }

    }
?>