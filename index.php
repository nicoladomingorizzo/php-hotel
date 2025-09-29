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
// Prende il voto richiesto. Uso isset per settare il GET usando un ternario. Di default è 1.
$voto_richiesto = isset($_GET['voto_richiesto']) ? $_GET['voto_richiesto'] : 1;
// Assicura che il voto sia sempre tra 1 e 5
$voto_richiesto = max(1, min(5, $voto_richiesto));

$filteredHotels = [];  // Array con solo gli hotel da visualizzare

// Entrambi i filtri in un unico foreach
foreach ($hotels as $hotel) {
    // Parcheggio (solo se richiesto)
    $parking_filter = true;
    if ($parcheggio_richiesto) {
        $parking_filter = $hotel['parking'] === true;
    }

    // Voto  dell'hotel deve essere maggiore o uguale a quello richiesto
    $vote_filter = $hotel['vote'] >= $voto_richiesto;

    // Se entrambe le condizioni sono soddisfatte, aggiungi l'hotel
    if ($parking_filter && $vote_filter) {
        $filteredHotels[] = $hotel;
    }
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
        <div class='park-input d-flex flex-column'>
            <label class='form-check-label' for="checkboxParking">
                Parcheggio
            </label>
            <input class="form-check-input mx-auto my-1 text-center" 
            type="checkbox" 
            value="true" 
            id="checkboxParking"
            name='parcheggio_disponibile'
            <?php
            // Se l'utente clicca, resta cliccato anche alla ricarica della pagina
            if ($parcheggio_richiesto) {
                echo 'checked';
            }
            ?>
        >
        </div>
        <div class='vote-input d-flex flex-column align-items-center mt-3'>
            <label for="rangeVote" class="form-label">Voto Hotel</label>
            <input type="range"
            class="form-range w-25" 
            min="1" 
            max="5" 
            step="1" 
            id="rangeVote"
            name='voto_richiesto' 
            value='<?php echo $voto_richiesto ?>'
            oninput="document.getElementById('currentVote').textContent = this.value">
            <div class="d-flex w-25 justify-content-between mt-n1 text-secondary" style="font-size: 0.8rem;">
                <span>1 Stella</span>
                <span>2 Stelle</span>
                <span>3 Stelle</span>
                <span>4 Stelle</span>
                <span>5 Stelle</span>
            </div>
        </div>
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