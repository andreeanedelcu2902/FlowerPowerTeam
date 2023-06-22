<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcVis Info</title>
    <link rel="stylesheet" href="styles/info_style.css">
    <link rel="stylesheet" href="styles/search_style.css">
</head>
<body>

  <div class="header">
    <img src="styles/resources/BG.png" alt="Imga" class="imga">
</div>

<div class="top">
    <ul class="menu">
      <li><a href="HOME.html" class="home">HOME</a></li>
      <li><a href="NEWS.html" class="news">NEWS</a></li>
      <li><a href="HELP.html" class="help">HELP</a></li>
      <li><a href="ACCOUNT.html" class="account">MY ACCOUNT</a></li>
    </ul>
</div>

<div class="sign-up-button">
  <a href="SIGN_UP.html" class="signup-link">Sign Up</a>
</div>

  
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $searchQuery = $_POST["searchInput"];
  
  // Verifică dacă s-a introdus un termen de căutare valid
  if (!empty($searchQuery)) {
    $apiKey = "469d46ba4a04e5e188f8845f264fdf96";
    $apiUrl = "https://api.themoviedb.org/3/search/multi?api_key={$apiKey}&query=" . urlencode($searchQuery);

    // Efectuează cererea și obține răspunsul JSON
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    // Verifică dacă există rezultate
    if ($data && isset($data["results"])) {
      $results = $data["results"];

      foreach ($results as $result) {
        if (isset($result["media_type"]) && ($result["media_type"] == "movie" || $result["media_type"] == "person")) {
          if ($result["media_type"] == "person") {
            $personId = $result["id"];
            $personName = $result["name"];
            $personProfilePath = $result["profile_path"];
            
            // Verifică dacă există suficiente informații pentru a afișa rezultatul actorului
            if (isset($personName, $personProfilePath)) {
              echo "<div class='result-item'>";
              echo "<img src='https://image.tmdb.org/t/p/w500{$personProfilePath}' alt='{$personName}'>";
              echo "<h3>{$personName}</h3>";
              echo "<a href='actor_details.php?id={$personId}' class='view-details'>View Details</a>";
              echo "</div>";
            }
          } else {
            $title = $result["title"] ?? $result["name"]; // Pentru filme
            $overview = $result["overview"];
            $releaseDate = $result["release_date"] ?? $result["first_air_date"]; // Pentru filme sau seriale TV
            $posterPath = $result["poster_path"];
            
            // Verifică dacă există suficiente informații pentru a afișa rezultatul filmului
            if (isset($title, $overview, $releaseDate, $posterPath)) {
              echo "<div class='result-item'>";
              echo "<h3>{$title}</h3>";
              echo "<p>{$overview}</p>";
              echo "<p>Release Date: {$releaseDate}</p>";
              echo "<img src='https://image.tmdb.org/t/p/w500{$posterPath}' alt='{$title}'>";
              echo "</div>";
            }
          }
        }
      }
       
      
      
      }
    }
  }

?>
