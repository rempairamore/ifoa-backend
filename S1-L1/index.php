<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php
    // set the default timezone to use.
        date_default_timezone_set('UTC+2');

        $mesi = [ 1 => 'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio',
            'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre',
            'Novembre', 'Dicembre' ];
        $giorni = ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];
        
        // $squadre = [
        //     "Atalanta",
        //     "Bologna",
        //     "Cagliari",
        //     "Empoli",
        //     "Frosinone",
        //     "Genoa",
        //     "Inter",
        //     "Juventus",
        //     "Lazio",
        //     "Milan",
        //     "Monza",
        //     "Napoli",
        //     "Roma",
        //     "Salernitana",
        //     "Sassuolo",
        //     "Torino",
        //     "Udinese",
        //     "Verona"
        // ];

        $squadre['Lecce'] = ['FALCONE', 'GENDREY', 'PONGRACIC', 'BASCHIROTTO', 'GALLO', 'KABA', 'RAFIA', 'GONZALEZ', 'ALMQVIST', 'KRSTOVIC', 'OUDIN'];
        $squadre['Fiorentina'] = ["TERRACCIANO", "KAYODE", "MILENKOVIC", "QUARTA", "BIRAGHI", "ARTHUR", "DUNCAN", "GONZALEZ", "BONAVENTURA", "SOTTIL", "BELTRAN"];
        
        $squadre['Frosinone'] = ["TURATI", "MONTERISI", "OKOLI", "ROMAGNOLI", "BRESCIANINI", "MAZZITELLI", "BARRENECHEA", "GELLI", "SOULÉ", "KAIO JORGE", "HARROUI"];
        $squadre['Milan'] = ["MAIGNAN", "CALABRIA", "KJAER", "GABBIA", "HERNANDEZ", "ADLI", "REIJNDERS", "PULISIC", "LOFTUS-CHEEK", "LEAO", "GIROUD"];
        
        $squadre['Bologna'] = ["SKORUPSKI", "POSCH", "BEUKEMA", "CALAFIORI", "KRISTIANSEN", "FREULER", "AEBISCHER", "ORSOLINI", "FERGUSON", "KARLSSON", "ZIRKZEE"];
        $squadre['Sassuolo'] = ["CONSIGLI", "PEDERSEN", "FERRARI", "ERLIC", "DOIG", "BOLOCA", "BAJRAMI", "CASTILLEJO", "THORSTVEDT", "LAURIENTÉ", "PINAMONTI"];

        echo "<h1 class='m-4 text-center'>" . $giorni[date('w')] . ", " . date('j') . " " . $mesi[date('n')] . " " . date('o') . "</h1>" ;


        foreach($squadre as $key => $value) {
            echo "<p class='ms-3'>Formazione per la squadra " . $key . "</p>";
            echo '<ul>';
            for($i=0;$i<count($value);$i++) {
                echo "<li>".$value[$i]."</li>";
            };
            echo '</ul>';
            
            
        };

        

    ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>