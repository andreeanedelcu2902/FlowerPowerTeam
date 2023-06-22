<?php
$apiKey = '469d46ba4a04e5e188f8845f264fdf96';

// Verificăm dacă ID-ul actorului a fost transmis prin metoda GET
if (isset($_GET['id'])) {
    $actorId = $_GET['id'];

    // URL-ul cererii către API-ul TMDB pentru a obține informațiile despre actor
    $url = "https://api.themoviedb.org/3/person/$actorId?api_key=$apiKey";

    // Efectuăm cererea și obținem răspunsul JSON
    $response = file_get_contents($url);

    // Verificăm dacă răspunsul a fost primit cu succes
    if ($response) {
        // Decodificăm răspunsul JSON într-un obiect PHP
        $data = json_decode($response);

        // Verificăm dacă există date valide despre actor
        if ($data) {
            $name = $data->name;
            $biography = $data->biography;
            $profileImageURL = 'https://image.tmdb.org/t/p/w500' . $data->profile_path;
            if (property_exists($data, 'known_for')) {
                $knownForMovies = $data->known_for;
            } else {
                $knownForMovies = [];
            }

            // Citim conținutul fișierului HTML
            $actorDetailsHTML = file_get_contents('actor_details.html');

            // Înlocuim variabilele din fișierul HTML cu valorile corespunzătoare
            $actorDetailsHTML = str_replace('{{actorName}}', $name, $actorDetailsHTML);
            $actorDetailsHTML = str_replace('{{actorProfileImage}}', $profileImageURL, $actorDetailsHTML);
            $actorDetailsHTML = str_replace('{{actorBiography}}', $biography, $actorDetailsHTML);

            // Generăm conținutul HTML pentru lista de filme cunoscute
            $knownForHTML = '';
            foreach ($knownForMovies as $movie) {
                $movieTitle = $movie->title;
                $knownForHTML .= "<li>$movieTitle</li>";
            }

            // Înlocuim eticheta "{{knownForMovies}}" din fișierul HTML cu conținutul generat
            $actorDetailsHTML = str_replace('{{knownForMovies}}', $knownForHTML, $actorDetailsHTML);

            // Afișăm conținutul HTML generat
            echo $actorDetailsHTML;
        } else {
            echo "No data found for the actor.";
        }
    } else {
        echo "Failed to fetch data from the API.";
    }
} else {
    echo "No actor ID provided.";
}
?>
