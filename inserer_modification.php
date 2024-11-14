<?php
session_start();
try{
    require_once("connexion.php");


if(isset($_POST['nom']) && isset($_POST['prenom']) &&isset($_POST['email'])&&isset($_POST['role'])&&isset($_POST['password'])&&isset($_POST['direction'])){
    
$nom = $_POST['nom'];
$prenom=$_POST['prenom'];
$email=$_POST['email'];
$role=$_POST['role'];
$password=$_POST['password'];
$direction=$_POST['direction'];
$code= $_POST['code'];

require_once("connexion.php");
$ins = $pdo->prepare("update agent set nom='$nom',prenom='$prenom',email='$email', role='$role' ,password='$password' where id_agent=$code"); 
$ins-> execute();
$_SESSION['message'] = 'Enregistrer avec succès.';
$_SESSION['msg_type'] = 'success';



}}
catch(Exception $e){

    $_SESSION['message'] = "Erreur de Modification";
    $_SESSION['msg_type'] = 'danger';}

    ?>
    


