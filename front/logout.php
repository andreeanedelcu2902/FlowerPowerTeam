<?php
session_start();

// Distrugerea sesiunii curente
session_destroy();

// Redirecționarea către pagina de autentificare sau orice altă pagină dorită
header("Location: SIGN_UP.html");
exit();
?>
