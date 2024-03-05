<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca in PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <main>
        <div class="container mt-3">
            <h2 class="mb-3">Inserisci Media: </h2>
            <form class="row gy-2 gx-3 align-items-center">
                <div class="col-auto">
                    <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                    <select class="form-select" id="autoSizingSelect" required>
                        <option selected>Scegli...</option>
                        <option value="1">Libro</option>
                        <option value="2">DVD</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="autoSizingInput">Titolo</label>
                    <input type="text" class="form-control" id="autoSizingInput" placeholder="Titolo..." required>
                </div>
                <div class="col-auto d-none" id="authorInput">
                    <label class="visually-hidden" for="autoSizingInput2">Autore</label>
                    <input type="text" class="form-control" id="autoSizingInput2" placeholder="Autore..." required>
                </div>
                <div class="col-auto d-none" id="directorInput">
                    <label class="visually-hidden" for="autoSizingInput3">Regista</label>
                    <input type="text" class="form-control" id="autoSizingInput3" placeholder="Regista..." required>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden" for="autoSizingInput4">Anno Pubblicazione</label>
                    <input type="number" min="1" max="2099" step="1" class="form-control" id="autoSizingInput4"
                        placeholder="Anno pubblicazione" required>
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </main>

    <!-- Qui parte PHP   -->
    <?php
    require_once "classes/biblio.php";
    use Biblioteca\Dvd as Film;
    use Biblioteca\Libro as Book;

    $dvd1 = new Film("Le iene", "1992", "Quentin Tarantino");
    $dvd2 = new Film("Arancia Meccanica", "1971", "Stanley Kubrick");
    $dvd3 = new Film("Il Padrino", "1972", "Francis Ford Coppola");
    $dvd4 = new Film("Serpico", "1973", "Sidney Lumet");

    $libro1 = new Book("Educazione Siberiana", "2009", "Nicolai Lilin");
    $libro2 = new Book("Inferno", "2013", "Dan Brown");
    $libro3 = new Book("Uno nessuno centomila", "1926", "Luigi Pirandello");
    $libro4 = new Book("Povere creature", "1900", "Alasdair Gray");


   echo "<br>I materiali attualmente in catalogono sono --->" . Film::getContatoreMateriali();

   $libro3->presta();
   echo "<br>I materiali attualmente in catalogono sono --->" . Film::getContatoreMateriali();

    ?>

    <h2 class="m-3">Proviamo Get Instance:</h2>

    <?php

    $config = require_once("config.php");
    require_once("db.php");

    use db\DB_PDO as Database;
    use dto\UserDTO as Dto;

    $pdoConn = Database::getInstance($config);
    $conn = $pdoConn->getConnection();
    var_dump($conn);

    $id = 0;
    $name = 'Francesca';
    $lastname = 'Neri';
    $city = 'Napoli';

    $userDTO = new Dto($conn);
    $res = $userDTO->getUserByID(0);
    //$res = $userDTO->getUserByID(2);

    var_dump($res);

    // if($res) { // Controllo se ci sono dei dati nella variabile $res
    //     foreach($res as $row) {
    //         print_r($row);
    //         echo "ajooo";
    //     }
    // }

    ?>







    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>