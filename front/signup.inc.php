<?php


require 'config.php';

$firstname=$_POST['Prenume'];
$lastname=$_POST['Nume'];
$email=$_POST['Email'];
$password=$_POST['Password'];

$sql="INSERT INTO users (prenume, nume, email, parola) VALUES ('$firstname', '$lastname', '$email', '$password')";
$_REQUEST=mysqli_query($conn, $sql);

if ($_REQUEST) {
   // Inserarea în baza de date s-a realizat cu succes - inițiați sesiunea și salvați informațiile de conectare ale utilizatorului
   session_start();
   $_SESSION['loggedin'] = true;
   $_SESSION['email'] = $email;
   
    header("Location: account.php");
    exit(); 
} else {
    
    echo "A apărut o eroare. Vă rugăm să încercați din nou.";
}

