<?php
require 'config.php';

//  actori cu cele mai multe premii SAG
$sql1 = "SELECT full_name, COUNT(*) AS total_wins
         FROM screen_actor_guild_awards
         WHERE won = 'true'
         GROUP BY full_name
         ORDER BY total_wins DESC LIMIT 10";

$result1 = mysqli_query($conn, $sql1);

$actori = array();
$premii = array();


if (mysqli_num_rows($result1) > 0) {
    
    while ($row = mysqli_fetch_assoc($result1)) {
        $actor = $row['full_name'];
        $numar_premii = $row['total_wins'];
        $actori[] = $actor;
        $premii[] = $numar_premii;
    }
}

// cele mai votate categorii
$sql2 = "SELECT category, COUNT(*) as total_votes FROM screen_actor_guild_awards GROUP BY category ORDER BY total_votes DESC LIMIT 5";
$result2 = mysqli_query($conn, $sql2);

$categorii = array();
$voturi = array();


if (mysqli_num_rows($result2) > 0) {
    
    while ($row = mysqli_fetch_assoc($result2)) {
        $categorie = $row['category'];
        $total_voturi = $row['total_votes'];
        $categorii[] = $categorie;
        $voturi[] = $total_voturi;
    }
}


//cele mai votate productii
$sql3 = "SELECT `show`, COUNT(*) AS total_nominalizari
        FROM screen_actor_guild_awards
        GROUP BY `show`
        ORDER BY total_nominalizari DESC
        LIMIT 5";

$result3 = mysqli_query($conn, $sql3);

$movies = array();

if (mysqli_num_rows($result3) > 0) {
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $show = $row3['show'];
        $numar_nominalizari = $row3['total_nominalizari'];
        $movies[] = array('show' => $show, 'numar_nominalizari' => $numar_nominalizari);
    }
}



?>
