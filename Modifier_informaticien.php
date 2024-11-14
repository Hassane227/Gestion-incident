<?php
session_start();
require_once("connexion.php");
$resultats = $pdo->query("SELECT id_direction, service FROM direction");

$code=$_GET['code'];
$ins = $pdo->prepare("select * from agent where id_agent=$code"); 

$ins->setFetchMode(PDO::FETCH_ASSOC); //Récupère la ligne suivante d'un jeu de résultats PDO
$ins->execute();

$tab = $ins->fetch();

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
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>Ajouter Employé</title>
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
        Modifier 
      </div>
      <div class="card-body">

    <form action="" method="post">
    <div class="form-group">
            <label for="nom_ens">Id agent:</label>
            <input type="text" name="code" class="form-control" value="<?php echo $tab['id_agent']?>">
        </div>
        <div class="form-group">
            <label for="nom_ens">Nom:</label>
            <input type="text" name="nom" class="form-control" value="<?php echo $tab['nom']?>">
        </div>

        <div class="form-group">
            <label for="anci">Prénom:</label>
            <input type="text" name="prenom" class="form-control" value="<?php echo $tab['prenom']?>">
        </div>

        <div class="form-group">
            <label for="mat">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $tab['email']?>">
        </div>

        <div class="form-group">
            <label for="grade">Rôle:</label>
            <select name="role" id="" class="form-control">
                <option value="Admin">Administrateur</option>
                <option value="Informaticien">Informaticien</option>
                <option value="Employé">Employé</option>

            </select>
        </div>
        <div class="form-group">
            <label for="mat">mot de passe : </label>
            <input type="password" name="password" class="form-control" value="<?php echo $tab['password']?>" >
        </div>

        <div class="form-group">
                    <label for="ens">Direction</label>
                    <select name="direction" id="ens" class="form-control" required>
                        <?php foreach($resultats as $row): ?>
                            <option value="<?= $row['id_direction'] ?>"> <?= $row['id_direction'] . '-' . $row['service'] ?></option>
                        <?php endforeach; ?>
                    </select>
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


