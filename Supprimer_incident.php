<?php
require_once("connexion.php");
$code =$_GET['code'];
$supprimer=$pdo->prepare("Delete  from incident  where id=$code");
$supprimer->execute();
require_once("afficher_incident.php");
?>