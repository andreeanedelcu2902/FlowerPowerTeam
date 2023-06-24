<?php
$apiKey = '469d46ba4a04e5e188f8845f264fdf96';

require_once 'add_to_favorites.php';

if (isset($_GET['id'])) {
    $actorId = $_GET['id'];


    $url = "https://api.themoviedb.org/3/person/$actorId?api_key=$apiKey";

    $response = file_get_contents($url);

    if ($response) {
  
        $data = json_decode($response);

       
        if ($data) {
            $name = $data->name;
            $biography = $data->biography;
            $profileImageURL = 'https://image.tmdb.org/t/p/w500' . $data->profile_path;
           


            $actorDetailsHTML = file_get_contents('../views/actor_details.html');

            $actorDetailsHTML = str_replace('{{actorName}}', $name, $actorDetailsHTML);
            $actorDetailsHTML = str_replace('{{actorProfileImage}}', $profileImageURL, $actorDetailsHTML);
            $actorDetailsHTML = str_replace('{{actorBiography}}', $biography, $actorDetailsHTML);
            $actorDetailsHTML = str_replace('{{actorId}}', $actorId, $actorDetailsHTML);


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
