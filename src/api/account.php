<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    
    echo "You are not logged in! Please login or create an account.. <a href='../views/SIGN_UP.html'>Login / Create account</a>";
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
    <link rel="stylesheet" href="../static/styles/style_account.css">
</head>
<body>
    <div class="header">
        <img src="../static/styles/resources/BG.png" alt="Imga" class="imga">
        <div class="search-container">
            <form method="POST" action="search.php">
                <input class="search-input" type="text" name="searchInput" placeholder="Search" />
                <button type="submit" class="search-button"><img src="../static/styles/resources/magnifying_glass.png" alt="Search"></button>
            </form>
        </div>
    </div>
    <div class="top">
        <ul class="menu">
            <li><a href="../views/HOME.html" class="home">HOME</a></li>
            <li><a href="news.php" class="news">NEWS</a></li>
            <li><a href="../views/HELP.html" class="help">HELP</a></li>
            <li><a href="account.php" class="help">MY ACCOUNT</a></li>
            <li><a href="logout.php">LOGOUT</a></li> 
        </ul>
    </div>      
    <h2>YOUR FAVORITE ACTORS</h2>
    <ul class="favorite-actors">
    <?php
        include 'add_to_favorites.php';
        
        $userId = $_SESSION['id'];
        $favoriteActors = getFavoriteActors($userId);
        
        if (isset($favoriteActors) && !empty($favoriteActors)) {
            foreach ($favoriteActors as $actor) {
                echo "<li>" . $actor['actor_name'] . "</li>";
            }
        } else {
            echo "<li>No favorite actors found.</li>";
        }
    ?>
</ul>



</body>
</html>
