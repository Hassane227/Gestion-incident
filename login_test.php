<?php

require_once("connexion.php");

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier dans la table des enseignants
    $requete_ens = $pdo->prepare("SELECT * FROM agent WHERE nom = :username AND password = :password");
    $requete_ens->bindParam(':username', $username);
    $requete_ens->bindParam(':password', $password);
    $requete_ens->execute();
    $utilisateur = $requete_ens->fetch(PDO::FETCH_ASSOC);
    if($utilisateur){
        if($utilisateur['role']=='Admin')
        {
            require 'init_session.php';
            session();
             
        $_SESSION['nom'] = $utilisateur['nom'];
        $_SESSION['password'] = $utilisateur['password'];

        header("Location:Acceuil_Admin.php");
        exit;
         }elseif($utilisateur['role']=='Employé')
        {  require 'init_session.php';
            session();
            $_SESSION['nom_agent'] = $utilisateur['nom'];
            $_SESSION['password_agent'] = $utilisateur['password'];
            $_SESSION['id_agent']=$utilisateur['id_agent'];
            header("Location:Menu_Agent.php");

            exit;
    

        }
        elseif($utilisateur['role']=='Informaticien'){
            require 'init_session.php';
            session();
            $_SESSION['id_informaticien']=$utilisateur['id_agent'];
            header("Location:interface_informaticien2.php");


        }
      }

    else{
        
            $erreur = "Nom d'utilisateur ou mot de passe incorrect.";
        
    }
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: rgb(255, 165, 0,0.2);

            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
      

        .container {
            width: 600px;
            height: 300px;
            padding: 20px;
            background-color: rgba(255, 102, 0, 0.827);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: black;
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
            color: black;
            font-weight: bold;
        }

        input {
            width: 250px;
            padding: 7px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 2px solid green;
            background-color:#fff; ;
        }

        input[type="submit"] {
            width: 270px;
            background-color: green;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: rgb(0, 128,0,0.6);
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .Div1 img {
            width: 300px;
            height: 300px;
            position: absolute;
        }

        .div2 {
            margin-left: 52%;
        }
    </style>
</head>
<body>
    <div id="global">
    
    <div class="container">
        
        <div class="Div1">
            <img src="images/bagri.jpg" alt="Image" width="300">
        </div>
        <div class="div2">
            <h2>Connexion</h2>
            <form action="" method="post">
                <label for="nom_utilisateur">Nom d'utilisateur :</label>
                <input type="text" id="nom_utilisateur" name="username" required placeholder="Nom:" autocomplete="off"><br>
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="password" placeholder="Mot de passe:" required autocomplete="off"><br>
                <input type="submit" value="Se connecter">
                <?php if (isset($block)) { ?>
                    <i><span class="error"><?= $block ?></span></i>
                <?php } elseif (isset($erreur)) { ?>
                    <i><span class="error"><?= $erreur ?></span></i>
                <?php } ?>
                
            </form>
        </div>
    </div>
</div>
</body>
</html>
