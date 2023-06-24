<?php
session_start();
require 'config.php';

if (!empty($_POST['Email']) && !empty($_POST['Password']) && isset($_POST['Email']) && isset($_POST['Password'])) {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $hash = $row['parola'];

    $check = password_verify($password, $hash);

    if ($check == false) {
        echo 'Parola sau adresa de email nu este corecta!';
    } else {
        $_SESSION['id'] = $row['id'];
        $_SESSION['prenume'] = $row['prenume'];
        $_SESSION['nume'] = $row['nume'];
        $_SESSION['loggedin'] = true;

        header("Location: account.php");
        exit(); 
    }
} else {
    echo "Mai incearca!";
    header("Location: signup.php");
    exit();
}
