<?php

namespace User {

    class User {
        private $username;
        private $email;

        function __construct($username, $email) {
            $this->username = $username;
            $this->email = $email;
        }

        function info() {
            return " Username: " . $this->username . " Email: " . $this->email;
        }
    }


    class Guest extends User {
        private $name;


        //Implementiamo il costruttore
        function __construct($name, $username, $email) {
            parent::__construct($username,$email);
            $this->name = $name;
        }

        //Override dei metodi -> sovrascrivo la lodica del metodo definito dalla superclasse
        function info() {
            //vado a cambiare il return in base alla sottoclasse
            // return "Name: " . $this->name . " Username: " . $this->username . " Email: " . $this->email;
            return " Name: " . $this->name . parent::info();
        }
    }

   

    class RegisterUser extends User{
        private $name;
        private $lastname;
        public $city;

        function __construct($username, $email, $name, $lastname, $city) {
            parent::__construct($username, $email);
            $this->name = $name;
            $this->lastname = $lastname;
            $this->city = $city;
        }

        //Override dei metodi -> sovrascrivo la lodica del metodo definito dalla superclasse
        function info() {
            //vado a cambiare il return in base alla sottoclasse
            return " Name: " . $this->name . " Lastname: " . $this->lastname . " City: " . parent::info();
        }
    }

    //Facciamo adesso un eredità da un altrà eredità, quindi da RegisterUser che già prendeva da User
    class Admin extends RegisterUser {
        private $fiscalcode;

        function __construct($username, $email, $name, $lastname, $city, $fiscalcode) {
            parent::__construct($username, $email, $name, $lastname, $city);
            $this->fiscalcode = $fiscalcode;
        }

        //Override dei metodi -> sovrascrivo la lodica del metodo definito dalla superclasse
        function info() {
            //vado a cambiare il return in base alla sottoclasse
            return "Fiscalcode: " . $this->fiscalcode . parent::info();
        }

    }
}