<?php

require 'config.php';

$email = $_POST['Email'];
$password = $_POST['Password'];

// Executați o interogare SELECT pentru a căuta în baza de date utilizând adresa de email și parola
$sql = "SELECT * FROM users WHERE email='$email' AND parola='$password'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
   // Autentificarea a reușit - inițiați sesiunea și salvați informațiile de conectare ale utilizatorului
   session_start();
   $_SESSION['loggedin'] = true;
   $_SESSION['email'] = $email;
   
   // Redirecționați utilizatorul către pagina "My Account"
   header("Location: account.php");
   exit();
} else {
    // Autentificarea a eșuat - afișați un mesaj de eroare
    echo "Email sau parolă incorectă.";
}

mysqli_close($conn);