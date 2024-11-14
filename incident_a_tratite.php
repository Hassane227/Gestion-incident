<?php
session_start();
require_once("connexion.php");
$id_informaticien =$_SESSION['id_informaticien'];
 $sel=$pdo->prepare("select affecter.id_incident,affecter.id_agent,incident.type_incident,affecter.date_affectation,
 affecter.classe_incident,affecter.priorite,affecter.statut_affectation,incident.id_incident
  from  affecter
  INNER JOIN incident ON affecter.id_incident = incident.id_incident
  Where infor = $id_informaticien ");
$sel->execute();
$tab = $sel->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="css/bootstrap.css">
<style>
    .justifier{
        margin-top: 10%;
        margin-left: 20%;
        width: 100%;
    }
    #traiter{
        background-color: green;
        border: 2px solid green;

    }
    #id_agent {
        background-color: orange;
        border: 1px solid orange;
    }
    
</style>


</head>
<body>

<?php include 'interface_informaticien.php'; ?>

<div class="justifier">
<div >
      <div>
        <h2 align="center">
              incident affecter        </h2>
      </div>
      <div class="card-body">
    <table width="100%"   class="table">
        <tr class="entete">
            <th>ID agent</th>
           <th>Date Affectation</th>
           <th>priorité</th>
           <th>statut</th>
           <th>incident</th>  
           <th>traiter incident</th>       
        </tr>
        <?php foreach ($tab as $el) { ?>
<tr>
<td><a href="Affiche_agent.php?code=<?php echo $el['id_agent'] ?>" class="btn btn-primary" id="id_agent"><?php echo $el['id_agent'] ?></a></td>

    <td><?php echo $el['date_affectation'] ?></td>
    <td><?php echo $el['priorite'] ?></td>
    <td><?php echo $el['statut_affectation']?></td>
    <td><?php echo $el['type_incident']  ?></td>
    <td><a href="traiter_incident.php?code=<?php echo $el['id_agent'] ?>&code2=<?php echo $el['date_affectation'] ?>&code3=<?php echo $el['id_incident'] ?>" class="btn btn-primary" id="traiter">Traiter</a></td>

</tr>
<?php } ?>
    </table> 

    </div>
</body>
</html>