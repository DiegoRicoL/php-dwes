<?php

    include "Soporte.php";

    class CintaVideo extends Soporte{
        private $duracion;

        public function __construct($titulo, $numero, $precio, $duracion){
            parent::__construct($titulo, $numero, $precio);
            $this->duracion = $duracion;
        }

        public function muestraResumen(){
            echo "<br>Película en VHS: ";
            echo parent::muestraResumen() . "<br>Duración: " . $this->duracion . " minutos";
        }
    }

    $miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
    echo "<strong>" . $miCinta->titulo . "</strong>";
    echo "<br>Precio: " . $miCinta->getPrecio() . " euros";
    echo "<br>Precio IVA incluido: " .
    $miCinta->getPrecioConIva() . " euros";
    $miCinta->muestraResumen();

?>