<?php
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Effacer le cookie de session s'il existe
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header('Location: login.php');
exit();
?>
