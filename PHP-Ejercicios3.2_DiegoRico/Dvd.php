<?php

    include "Soporte.php";

    class Dvd extends Soporte {
        public $idiomas;

        private $formatPantalla;


        public function __construct($titulo, $numero, $precio, $idiomas, $formatPantalla){
            parent::__construct($titulo, $numero, $precio);
            $this->idiomas = $idiomas;
            $this->formatPantalla = $formatPantalla;
        }

        public function muestraResumen(){
            echo "<br>Película en DVD:";
            echo parent::muestraResumen() . "<br>Idiomas:" . $this->idiomas . "<br>Formato Pantalla:" . $this->formatPantalla;
        }
    }

    $miDvd = new Dvd("Origen", 24, 15, "es,en,fr",
    "16:9");
    echo "<strong>" . $miDvd->titulo . "</strong>";
    echo "<br>Precio: " . $miDvd->getPrecio() . " euros";
    echo "<br>Precio IVA incluido: " .
    $miDvd->getPrecioConIva() . " euros";
    $miDvd->muestraResumen();

?>