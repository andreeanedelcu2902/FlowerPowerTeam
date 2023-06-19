<?php
// Conectare la baza de date
include 'config.php';


// Interogare SQL pentru a selecta primele 6 actori dupa poza
$sql = "SELECT * FROM actors ORDER BY id LIMIT 6";
$result = $conn->query($sql);

// Verificare rezultate
if ($result->num_rows > 0) {
    // Afisare poza
    while ($row = $result->fetch_assoc()) {
        $image = $row['imageURL'];
        $name = $row['full_name'];
      

        echo '<div class="grid-item">';
        echo "<a href='plant_page.html?name=$name'><img src='$image' alt='$name'></a>";
        echo "<h3 class='product-name'>$name</h3>";
        echo '</div>';
    }
} else {
    echo "Nu s-au gasit actori.";
}

// Inchidere conexiune
$conn->close();
?>
