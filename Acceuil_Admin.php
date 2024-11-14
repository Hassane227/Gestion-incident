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

}
    .fixed-menu {
    position: fixed;
   
    width: 20%;
    background-color: rgba(255, 102, 0, 0.827);
    color: #fff;
    font-weight: bold;
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
            margin-bottom: 21.5px; /* Espacement entre les liens */
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 0px 10px;
            border-radius: 5px;
            display: block; /* Affichage en bloc pour le positionnement vertical */
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover {
            background-color: green;
        }
        header{
            height: 70px;
            width: 100%;
            margin-left: 21.5%;
            background-color: rgba(255, 102, 0, 0.827);
            position: fixed;
        
            font-weight: bold;
            border: 2px solid green;
           
        }
        header #recherchee{
            margin-left: 20px;
        }
        header #recherchee input{
            margin-top: 11px;
            width: 25%;
            height: 30px;
            border-radius:10px ;
            
        }
        header #recherchee input[type="submit"]{
            background-color: green;
            width: 100px;
            height: 32px;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            border: 1px solid green;
            margin-left: -50px;

            
        }
        img{
            width: 50%;
            margin-left: 20%;
            border-radius: 10%;
        }
        #deconnexion{

            margin-left: 40%;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;


        }
        #deconnexion:hover{
          background-color: green;
            

        }

    </style>
</head>
<body>
<header>
<div id="recherchee" >
<input type="text">
<input type="submit" value="recherche" id="recherche">
<a href="deconnexion.php" id="deconnexion">Déconnexion</a>

</div>
</header>


    <nav class="fixed-menu" >
        <div> 
             <img src="images/bagri.jpg" alt=""><br> 
        </div> 
        <ul>
            <br><br>
            <li><a href="Acceuil_Admin.php">Accueil</a></li>
            <li><a href="ajouter_direction.php">Ajouter une direction</a></li>
            <li><a href="ajouter_incident.php">Ajouter un incident</a></li>
            <li><a href="ajouterEmployer.php">Ajouter un agent</a></li>
            <li><a href="ajouter_declaration.php">Ajouter une declaration</a></li>
            <li><a href="affecter_incident.php">Affecter incident</a></li>
            <li><a href="Afficher_declaration_Admi.php">Liste des declarations</a></li>

            <li><a href="Afficher_Affectation_Admi.php">Liste Affectation</a></li>
            <li><a href="incident_traiter_Admi.php">incident traité</a></li>

            <li><a href="Afficher_direction.php">Liste des direction</a></li> 
            <li><a href="Afficher_Employer_Admin.php">Liste des agents</a></li>
            <li><a href="Afficher_informaticien.php">Liste des informaticiens</a></li>
            <li><a href="Afficher_incident.php">Liste des incidents</a></li>
        </ul>
    </nav>
    <div>
       
    </div>
  
</body>
</html>