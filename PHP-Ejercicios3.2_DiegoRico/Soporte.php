<?php
    include "Resumible.php";

    abstract class Soporte implements Resumible{
        public $titulo;
        protected $numero;

        private $precio;

        private const iva = 0.21;

        public function __construct($titulo, $numero, $precio){
            $this->titulo = $titulo;
            $this->numero = $numero;
            $this->precio = $precio;
        }

        public function getPrecio(){
            return $this->precio;
        }

        public function getPrecioConIVA(){
            return $this->precio+($this->precio*self::iva);
        }

        public function muestraResumen(){
            echo "<br>" . $this->titulo . "<br>" . $this->getPrecio() . " € (IVA NO INCLUIDO)";
        }
    }

    // $soporte1 = new Soporte("Tenet", 22, 3);
    // echo "<strong>" . $soporte1->titulo . "</strong>";
    // echo "<br>Precio: " . $soporte1->getPrecio() . " euros";
    // echo "<br>Precio IVA incluido: " .
    // $soporte1->getPrecioConIVA() . " euros";
    // $soporte1->mostrarResumen();
?>