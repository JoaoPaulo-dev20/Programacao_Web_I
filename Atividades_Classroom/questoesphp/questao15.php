<?php
class Carro {
    public $modelo;

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function getModelo() {
        return $this->modelo;
    }
}

$carro1 = new Carro();
$carro1->setModelo("Civic");

echo $carro1->getModelo();
?>