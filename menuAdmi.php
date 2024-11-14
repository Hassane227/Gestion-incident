<?php
require 'init_session.php';
session();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <style>


h1{
    align-content: center;
    text-align: center;
    margin-left:50%;

}
    .fixed-menu {
    position: fixed;
   
    width: 20%;
    background-color: rgba(255, 102, 0, 0.827);
    color: #fff;
    border: 2px solid green;
   /* Assure que le menu reste au-dessus du contenu */
}
        /* Style de base pour le menu */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav {
            
            background-color: #333;
            color: #fff;
            padding: 10px;
            /* Modification pour le placement à gauche */
            width: 10%;
            height: 750px;
            flex-shrink: 0;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            margin-bottom: 30px; /* Espacement entre les liens */
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            display: block; /* Affichage en bloc pour le positionnement vertical */
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover {
            background-color: blue;
        }

    </style>
</head>
<body>
<header>
<div id="recherchee" >



</div>
</header>


    <nav class="fixed-menu">
  

        <ul>

            <li><a href="menuAdmi.php">Accueil</a></li>
            <li><a href="#">Ajouter un incident</a></li>
            <li><a href="#">Ajouter un Employé</a></li>
            <li><a href="#">Liste des Employés</a></li>
            <li><a href="#">Liste des informaticiens</a></li>
            <li><a href="#">Liste des incidents</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </nav>
    <!-- Contenu de l'application -->
    <div>
        <!-- Votre contenu ici -->
    </div>
</body>
</html>
