<?php


session_unset();

session_destroy();

// Redirigez l'utilisateur vers une page d'accueil ou une autre page
header("location: login_test.php"); // Remplacez "index.php" par la page vers laquelle vous souhaitez rediriger
exit;
?>
