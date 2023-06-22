<?php
$apiKey = '469d46ba4a04e5e188f8845f264fdf96';

// URL-ul cererii către API-ul TMDB pentru a obține imaginile de actori
$url = "https://api.themoviedb.org/3/person/popular?api_key=$apiKey";

// Efectuarea cererii și obținerea răspunsului JSON
$response = file_get_contents($url);

// Verificarea dacă răspunsul a fost primit cu succes
if ($response) {
    // Decodificarea răspunsului JSON într-un obiect PHP
    $data = json_decode($response);

    // Verificarea dacă există rezultate
    if ($data && isset($data->results)) {
        $actors = $data->results;

        // Iterarea prin lista de actori și afișarea imaginilor și numelor lor
        foreach ($actors as $actor) {
            $imageURL = 'https://image.tmdb.org/t/p/w500' . $actor->profile_path;
            $name = $actor->name;
            $actorId = $actor->id;
        
            echo '<div class="grid-item">';
            echo "<a href='actor_details.php?id=$actorId'><img src='$imageURL' alt='$name'></a>";
            echo "<h3 class='product-name'>$name</h3>";
            echo '</div>';
        }
        
    } else {
        echo "Nu s-au găsit actori.";
    }
} else {
    echo "Eroare la obținerea datelor de la API.";
}
?>
