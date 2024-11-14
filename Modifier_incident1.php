<?php

require_once("connexion.php");
$code=$_GET['code'];
$ins = $pdo->prepare("select* from incident where id_incident=$code"); 
$ins->setFetchMode(PDO::FETCH_ASSOC); //Récupère la ligne suivante d'un jeu de résultats PDO
$ins->execute();
$tab = $ins->fetch();

try{

if(isset($_POST['nom'])){

require_once("connexion.php");
$nom = $_POST['nom'];
$ins = $pdo->prepare("update incident set type_incident='$nom' where id_incident=$code"); 
$ins-> execute();
$_SESSION['message'] = 'Enregistrer avec succès.';
$_SESSION['msg_type'] = 'success';
header("location:Afficher_incident.php");


}}
catch(Exception $e){

    $_SESSION['message'] = "Erreur de Modification";
    $_SESSION['msg_type'] = 'danger';}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>Modifier incident</title>
    <style>
        .global{
            margin-left: 20%;
            margin-top: 5%;
            width: 80%;
        }
        input{
            width: 100%;
        }
        #bt{
            background-color: green;
            border: 1px solid green;
            margin-top: 10px;
            font-weight: bold;
            margin-left: 43%;
            width: 20%;
        }
        #bt:hover{
            background-color: rgb(0, 128, 0,0.8);
        }
    </style>
</head>

<body>
<?php include 'Admin.php'; ?>
<div class="global">
<div class="container mt-5 " id="ajouter">
<div class="card">
      <div class="card-header">
        Modifier incident
      </div>
      <div class="card-body">

    <form action="" method="post">
   
        <div class="form-group">
            <label for="nom_ens">Service:</label>
            <input type="text" name="nom" class="form-control" value="<?php echo $tab['type_incident']?>">
        </div>


      </div> <?php if (isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?=$_SESSION['msg_type']?>">
                                    <?=$_SESSION['message']?>
                                    <?php
                                    // Détruisez le message après l'affichage
                                    unset($_SESSION['message']);
                                    unset($_SESSION['msg_type']);
                                    ?>
                                </div>
                            <?php endif; ?>

        <button type="submit" class="btn btn-primary" id="bt">Valider</button>
    </form>
</div>
</div>

</body>

</html>
