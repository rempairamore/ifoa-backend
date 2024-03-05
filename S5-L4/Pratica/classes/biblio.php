<?php

namespace Biblioteca {
    interface Prestito {
        public function presta();

        public function restituisci();
    }


    abstract class MaterialeBibliotecario implements Prestito {
        static $contatoreMateriali = 0;
        private $titolo;
        private $annoPubblicazione;

        function __construct($titolo, $annoPubblicazione) {
            $this->titolo = $titolo;
            $this->annoPubblicazione = $annoPubblicazione;
            self::$contatoreMateriali++;
        }

        public static function getContatoreMateriali() {
            return self::$contatoreMateriali;
        }
        
    }

    class Libro extends MaterialeBibliotecario {
     
        private $autore;
        static $contaLibri = 0;

        function __construct($titolo, $annoPubblicazione, $autore) {
            parent::__construct($titolo,$annoPubblicazione);
            $this->autore = $autore;
            self::$contaLibri++;
        }

        function presta() {
            echo "libro prestato";
            self::$contaLibri--;
            parent::$contatoreMateriali--;

        }

        function restituisci() {
            echo "libro restituito";
            self::$contaLibri++;
            parent::$contatoreMateriali++;

        }

        public static function getContaLibri() {
            return self::$contaLibri;
        }
        
    }

    class Dvd extends MaterialeBibliotecario {

        private $regista;
        static $contaDvd = 0;

        function __construct($titolo, $annoPubblicazione, $regista) {
            parent::__construct($titolo,$annoPubblicazione);
            $this->regista = $regista;
            self::$contaDvd++;
        }

        function presta() {
            echo "DVD prestato";
            parent::$contatoreMateriali--;
            self::$contaDvd--;
            

        }
    
        function restituisci() {
            echo "DVD restituito";
            parent::$contatoreMateriali++;
            self::$contaDvd++;
    
        } 

        public static function getContaDvd() {
            return self::$contaDvd;
        }
    }

   

}