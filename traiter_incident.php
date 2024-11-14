<?php
try{
session_start();
    require_once("connexion.php");
$id_agent= $_GET['code'];
$date_affectation = $_GET['code2'];
$id_incident = $_GET['code3'];
$ins = $pdo->prepare("select * from affecter where id_agent=$id_agent and date_affectation='$date_affectation' and id_incident = $id_incident"); 
$ins->setFetchMode(PDO::FETCH_ASSOC); //Récupère la ligne suivante d'un jeu de résultats PDO
$ins->execute();
$el = $ins->fetch();

if(isset($_POST['statut'])&&isset($_POST['date_debut'])&&isset($_POST['date_fin'])){
    $statut=$_POST['statut'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $ins = $pdo->prepare("update affecter set date_debut_trai='$date_debut' ,date_fin_trai = '$date_fin',statut_affectation='$statut' where id_agent=$id_agent and date_affectation ='$date_affectation' and id_incident=$id_incident"); 
    $ins-> execute();
    $_SESSION['message'] = 'traité avec succès.';
    $_SESSION['msg_type'] = 'success';
}

}catch(Exception $e){

    $_SESSION['message'] = "Erreur votre incident n'est pas traité";
    $_SESSION['msg_type'] = 'danger';}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>traité incident</title>
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
<?php include 'interface_informaticien.php'; ?>

<div class="global">
<div class="container mt-5 " id="ajouter">
<div class="card">
      <div class="card-header">
        traité incident
      </div>
      <div class="card-body">

    <form action="" method="post">
   
        <div class="form-group">
            <label for="date"> Date Affectation: <?php echo $el['date_affectation'];?> </label>
        </div><br>

    

        <div class="form-group">
          <label for="priorite">priorité:  <?php echo $el['priorite'];?></label>
          </div><br>

        <div class="form-group">
            <label for="statut">Mise a jour Statut:</label>
          <select id="statut" name="statut" class="form-control" required>
            <option value="Ouvert">Ouvert</option>
            <option value="En cours">En cours</option>
            <option value="Résolu">Résolu</option>
            <option value="Fermé">Fermé</option>
        </select>
        </div>

        
        <div class="form-group">
            <label for="date">Date debut traitement</label>
            <input type="date" name="date_debut" class="form-control" value="<?php echo $el['date_debut_trai'];?>">
        </div>
        <div class="form-group">
            <label for="date">Date fin traitement</label>
            <input type="date" name="date_fin" class="form-control" value="<?php echo $el['date_fin_trai'];?>">
        </div>
        
        
        
      
     
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
                            </>

        <button type="submit" class="btn btn-primary" id="bt">Valider</button>
    </form>
</div>
</div>

</body>
</html>
