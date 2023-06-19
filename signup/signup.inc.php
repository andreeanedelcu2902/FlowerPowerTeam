<?php


require 'config.php';

$firstname=$_POST['Prenume'];
$lastname=$_POST['Nume'];
$email=$_POST['Email'];
$password=$_POST['Password'];

$sql="INSERT INTO users (prenume, nume, email, parola) VALUES ('$firstname', '$lastname', '$email', '$password')";
$_REQUEST=mysqli_query($conn, $sql);

