<?php

$title = 'PHP Hotels';

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

// Uso isset per settare il GET e con && definisco il GET
$parcheggio_richiesto = isset($_GET['parcheggio_disponibile']) && $_GET['parcheggio_disponibile'] === 'true';
$filteredHotels = [];  // Array con solo gli hotel da visualizzare

if ($parcheggio_richiesto) {
    // Solo hotel con parcheggio (parking: true)
    foreach ($hotels as $hotel) {
        if ($hotel['parking'] === true) {
            $filteredHotels[] = $hotel;
        }
    }
} else {
    // Se l'utente non ha spuntato la checkbox visualizza tutti gli hotel (rendendo gli hotel filtrati uguali agli hotel non filtrati).
    $filteredHotels = $hotels;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title><?php echo $title ?></title>
</head>
<body class='text-center'>

    <!-- Titolo -->
    <h1 class='my-5 p-2'>
        <?php
        echo $title
        ?>
    </h1>

    <!-- Form Filtro Parcheggio -->
    <form class="form-check mb-5 d-flex flex-column container" action='' method='GET'>
        <br>
        <input class="form-check-input mx-auto my-1 text-center" 
        type="checkbox" 
        value="true" 
        id="checkboxParking"
        name='parcheggio_disponibile'
        <?php
        // Se l'utente clicca, resta cliccato
        if ($parcheggio_richiesto) {
            echo 'checked';
        }
        ?>
        >
        <label class='form-check-label' for="checkboxParking">
                Presenza parcheggio
        </label>
        <button type="submit" class="btn btn-outline-primary mt-3 btn-sm mx-auto">Filtra</button>
    </form>

        <!-- Tabella Hotels -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome Hotel</th>
                <th scope="col">Descrizione Hotel</th>
                <th scope="col">Presenza Parcheggio</th>
                <th scope="col">Voto</th>
                <th scope='col'>Distanza dal centro (Km)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($filteredHotels as $hotel) {
            echo '<tr>';
            // Proprietà dell'hotel (name, description, parking, vote, distance_to_center)
            foreach ($hotel as $key => $value) {
                // Gestione per 'parking'
                if ($key === 'parking') {
                    $display_value = $value ? 'Sì' : 'No';
                } else {
                    $display_value = $value;
                }

                echo '<td>' . $display_value . '</td>';
            }
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>