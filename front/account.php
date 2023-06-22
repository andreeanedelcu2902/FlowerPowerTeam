<?php
session_start();

// Verificați dacă utilizatorul este conectat
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Utilizatorul nu este conectat - afișați un mesaj și oferiți opțiunea de a se autentifica
    echo "Nu sunteți conectat! Vă rugăm să vă autentificați sau să creați un cont. <a href='SIGN_UP.html'>Autentificare / Creare cont</a>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="styles/style_account.css">
</head>
<body>
<div class="header">
        <img src="styles/resources/BG.png" alt="Imga" class="imga">
        <div class="search-container">
        <form method="POST" action="search.php">
          <input class="search-input" type="text" name="searchInput" placeholder="Search" />
          <button type="submit" class="search-button"><img src="styles/resources/magnifying_glass.png" alt="Search"></button>
        </form>
      </div>
    </div>
    <div class="top">
        <ul class="menu">
          <li><a href="HOME.html" class="home">HOME</a></li>
          <li><a href="NEWS.html" class="news">NEWS</a></li>
          <li><a href="HELP.html" class="help">HELP</a></li>
          <li><a href="ACCOUNT.html" class="help">MY ACCOUNT</a></li>

        </ul>
    </div>      

    <h2>YOUR FAVORITE ACTORS & MOVIES</h2> <!-- Adăugarea textului "Favorite" -->
    <ul class="favorite-actors">
        <li>Actor 1</li>
        <li>Actor 2</li>
        <li>Actor 3</li>
        <!-- Adăugați aici actorii tăi preferați -->
    </ul>
    <script src="script.js"></script>
</body>
</html>
