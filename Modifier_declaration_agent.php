
<?php
session_start();
require_once("connexion.php");
$resultat = $pdo->query("SELECT id_incident,type_incident FROM incident");

$code=$_GET['code'];
$date = $_GET['code2'];

$code=$_GET['code'];
$ins = $pdo->prepare("select * from declaration where id_agent=$code and date_declaration='$date'"); 

$ins->setFetchMode(PDO::FETCH_ASSOC); //Récupère la ligne suivante d'un jeu de résultats PDO
$ins->execute();
$tab = $ins->fetch();


try{
    require_once("connexion.php");

    $resultat = $pdo->query("SELECT id_incident,type_incident FROM incident");

    $code=$_GET['code'];
    $date_ancien = $_GET['code2'];
    $commentaire_ancien = $_GET['code3'];
    $motif_ancien = $_GET['code4'];
    
    $code=$_GET['code'];
    $ins = $pdo->prepare("select * from declaration where id_agent=$code and date_declaration='$date_ancien' and motif='$motif_ancien' and commentaire='$commentaire_ancien' "); 
    
    $ins->setFetchMode(PDO::FETCH_ASSOC); //Récupère la ligne suivante d'un jeu de résultats PDO
    $ins->execute();
    $tab = $ins->fetch();

    if(isset($_POST['date']) && isset($_POST['motif']) &&isset($_POST['commentaire'])&&isset($_POST['lieu'])&&isset($_POST['id_incident'])){
        $date_ancien = $_GET['code2'];
        $commentaire_ancien = $_GET['code3'];
        $motif_ancien = $_GET['code4'];
    $date = $_POST['date'];
    $motif=$_POST['motif'];
    $commentaire=$_POST['commentaire'];
    $incident=$_POST['id_incident'];
    $id_agent = $_SESSION['id_agent'];
    $lieu = $_POST['lieu'];

$ins = $pdo->prepare("update declaration set date_declaration='$date' ,motif = '$motif',commentaire ='$commentaire',lieu = '$lieu',id_incident = $incident where 
id_agent=$id_agent and date_declaration = '$date_ancien' and commentaire= '$commentaire_ancien' and motif = '$motif_ancien' "); 
$ins-> execute();
$_SESSION['message'] = 'Enregistrer avec succès.';
$_SESSION['msg_type'] = 'success';

header("location:Afficher_declaration_agent.php");



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

    <title>déclaration incident</title>
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
<?php include 'interface_agent.php'; ?>
<div class="global">
<div class="container mt-5 " id="ajouter">
<div class="card">
      <div class="card-header">
      Modifier incident
      </div>
      <div class="card-body">

    <form action="" method="post">
   
        <div class="form-group">
            <label for="date">Date déclaration </label>
            <input type="date" name="date" class="form-control" value="<?php echo $tab['date_declaration']?>">
        </div>


        <div class="form-group">
            <label for="mat">Motif</label>
            <input type="text" name="motif" class="form-control" value="<?php echo $tab['motif']?>">
        </div>

        <div class="form-group">
            <label for="commentaire">commentaire:</label>
            <input name="commentaire" id="" class="form-control" value="<?php echo $tab['commentaire']?>">

        </div>
        
        <div class="form-group">
            <label for="lieu">lieu:</label>
            <input  name="lieu" id="" class="form-control" value="<?php echo $tab['lieu']?>">

        </div>
       

        <div class="form-group">
                    <label for="ens">Type incident</label>
                    <select name="id_incident" id="ens" class="form-control" required>
                        <?php foreach($resultat as $row): ?>
                            <option value="<?= $row['id_incident'] ?>"> <?= $row['id_incident'] . '-' . $row['type_incident'] ?></option>
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
