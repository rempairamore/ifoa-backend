<?php

class Car {
    private $targa;

    function __construct($targa) {
        $this->targa = $targa;
    }
}


class Suv extends Car {
    public $cilindrata;

    public function __construct($targa, $cilindrata) {
        // Con parent andiamoa prendere il costruttore padre quindi della superclasse
        parent::__construct($targa);
        $this->cilindrata = $cilindrata;
    }
}