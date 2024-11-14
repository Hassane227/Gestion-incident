
<?php
session_start();

try{

    require_once("connexion.php");
$id_agent_ancien = $_GET['code'];
$date_affectation =$_GET['code2'];
$priorite_ancien = $_GET['code3'];
$statut_ancien=$_GET['code4'];
$selectedAgentId = $id_agent_ancien;
$ins = $pdo->prepare("select * from affecter where id_agent = $id_agent_ancien and date_affectation = '$date_affectation' and priorite = '$priorite_ancien' and statut_affectation='$statut_ancien'"); 
$ins->setFetchMode(PDO::FETCH_ASSOC); //Récupère la ligne suivante d'un jeu de résultats PDO
$ins->execute();
$tab = $ins->fetch();

    $resultats = $pdo->query("SELECT id_agent,nom,prenom  FROM agent where role ='Informaticien'");
    $resultat = $pdo->query("SELECT id_incident,type_incident FROM incident");
    $agent_decla =$pdo->query("SELECT declaration.id_agent,agent.nom,agent.prenom FROM declaration
    INNER JOIN agent ON declaration.id_agent = agent.id_agent");
  

if(isset($_POST['date'])&&isset($_POST['priorite'])&&isset($_POST['statut']))
{
    $date = $_POST['date'];
    $priorite=  $_POST['priorite'];
    $statut =  $_POST['statut'];
    $id_agent =  $_POST['id_agent'];
    $id_informaticien = $_POST['id_informaticien'];
    $id_incident =  $_POST['incident'];

    $ins = $pdo->prepare("update affecter set date_affectation='$date' ,priorite = '$priorite',statut_affectation =' $statut',id_agent = $id_agent,infor = '$id_informaticien 'where 
    id_agent=$id_agent_ancien  and date_affectation = '$date_affectation' and priorite= '$priorite_ancien' and statut_affectation = '$statut_ancien' "); 
    $ins-> execute();
  
$_SESSION['message'] = 'Modifié avec succès.';
$_SESSION['msg_type'] = 'success';
}


}
catch(Exception $e){

    $_SESSION['message'] = "Echec d'Affectation";
    $_SESSION['msg_type'] = 'danger';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">

    <title> Modifier Affectation</title>
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
<?php include'Admin.php'; ?>
<div class="global">
<div class="container mt-5 " id="ajouter">
<div class="card">
      <div class="card-header">
      Modifier Affectation      </div>
      <div class="card-body">

    <form action="" method="post">
   
        <div class="form-group">
            <label for="date">Date Affectation </label>
            <input type="date" name="date" class="form-control"value="<?php echo $tab['date_affectation']?>">
        </div>

    

        <div class="form-group">
            <label for="priorite">Priorité:</label>
            <select name="priorite" id="priorite" class="form-control">
            <option value="Basse">Basse</option>
            <option value="Moyenne">Moyenne</option>
            <option value="Haute">Haute</option>
            </select>
          </div>

        <div class="form-group">
            <label for="statut">Statut:</label>
          <select id="statut" name="statut" class="form-control" required>
            <option value="Ouvert">Ouvert</option>
            <option value="En cours">En cours</option>
            <option value="Résolu">Résolu</option>
            <option value="Fermé">Fermé</option>
        </select>
        </div>
        
        <div class="form-group">
                    <label for="ens">Agent déclarant </label>
                    <select name="id_agent" id="ens" class="form-control" required>
                        <?php foreach( $agent_decla as $row): ?>
                            <option value="<?= $row['id_agent'] ?>"> <?= $row['id_agent'] . '-' . $row['nom'].' '.$row['prenom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">

                    <label for="incident">incident</label>
                    <select name="incident" id="ens" class="form-control" required>
                        <?php foreach($resultat as $row): ?>
                            <option value="<?= $row['id_incident'] ?>"> <?= $row['id_incident'] . '-' . $row['type_incident'] ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="form-group">
                <label for="ens">Informaticien</label>
                <select name="id_informaticien" id="ens" class="form-control" required>
                    <?php foreach ($resultats as $row): ?>
                        <option value="<?= htmlspecialchars($row['id_agent']) ?>" 
                                <?= $row['id_agent'] == $selectedAgentId ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['id_agent']) . ' - ' . htmlspecialchars($row['nom']) . ' ' . htmlspecialchars($row['prenom']) ?>
                        </option>
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
                            </>

        <button type="submit" class="btn btn-primary" id="bt">Valider</button>
    </form>
</div>
</div>

</body>
</html>
