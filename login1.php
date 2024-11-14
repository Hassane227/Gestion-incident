<?php

require_once("connexion.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
    require 'init_session.php';
    session();
    
    $username = $_POST['username'];
    $password = $_POST['password'];




    // Vérifier dans la table des enseignants
    $requete_ens = $pdo->prepare("SELECT * FROM utilisateur WHERE nom = :username AND mot_de_passe = :password");
    $requete_ens->bindParam(':username', $username);
    $requete_ens->bindParam(':password', $password);
    $requete_ens->execute();
    $utilisateur = $requete_ens->fetch(PDO::FETCH_ASSOC);
    if($utilisateur){
        if($utilisateur["rôle"]=="Admin")
        $_SESSION['nom'] = $utilisateur['nom'];
        $_SESSION['password'] = $utilisateur['mot_de_passe'];

        header("Location:menuAdmi.php");    }
    else{
        echo "sass tu n'as pas compri";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action=""  method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>
