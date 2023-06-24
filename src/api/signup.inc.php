<?php


require 'config.php';

if(!empty($_POST['Prenume']) && !empty($_POST['Nume']) && !empty($_POST['Email']) && !empty($_POST['Password'])
 &&isset($_POST['Prenume']) && isset($_POST['Nume']) && isset($_POST['Email']) && isset($_POST['Password']))
 {

    $firstname=$_POST['Prenume'];
    $lastname=$_POST['Nume'];
    $email=$_POST['Email'];
    $password=$_POST['Password'];

    $password_hashed= password_hash($password, PASSWORD_DEFAULT);

    $sql="SELECT email from users where email='$email'";
    $result=mysqli_query($conn, $sql);
    $check=mysqli_num_rows($result);

if($check>0){
    header("Location: signup.php");
    die();
}
else{
    
    $sql="INSERT INTO users (prenume, nume, email, parola) VALUES ('$firstname', '$lastname', '$email', '$password_hashed')";
    $result=mysqli_query($conn, $sql);
    $_SESSION['loggedin'] = true;


    if ($result) {

        $_SESSION['id'] = mysqli_insert_id($conn);
        $_SESSION['prenume'] = $firstname;
        $_SESSION['nume'] = $lastname;


        echo '<p style="color: green; font-weight: bold;">Contul tău a fost creat cu succes!</p>';
        header("Location: ACCOUNT.html"); 
        exit; 
    }
    
}
 }
 else{

   echo "Mai incearca!";
    header("Location: signup.php");

 }

