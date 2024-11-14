<?php
session_start();
require_once("connexion.php");

$id_agent = $_SESSION['id_agent'];


 $sel=$pdo->prepare("select declaration.id_agent,declaration.date_declaration,declaration.motif,declaration.commentaire,declaration.lieu,incident.type_incident,incident.id_incident
  from declaration
  INNER JOIN incident ON declaration.id_incident = incident.id_incident
  where id_agent=$id_agent ");
$sel->execute();
$tab = $sel->fetchAll();



$mot="";

if(isset($_POST['mot']) && !empty($_POST['mot'])){

    $mot=$_POST['mot'];
    $sel=$pdo->prepare("select * from enseignant where nom_ens like '%$mot%'");
$sel->execute();
$tab = $sel->fetchAll();}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Mes déclaration</title>



<style>
    .justifier{
        margin-top: 10%;
        margin-left: 20%;
        width: 100%;
    }
    #Modifier{
        background-color: green;
        border: 1px solid green;

    }
    
</style>


</head>
<body>

<?php include 'interface_agent.php'; ?>

<div class="justifier">
<div >
      <div>
        <h2 align="center">
          Mes déclaration
        </h2>
      </div>
      <div class="card-body">
    <table width="100%"   class="table">
        <tr class="entete">
           <th>ID</th>
           <th>Date déclaration</th>
           <th>Motif</th>
           <th>Commentaire</th>
           <th>Lieu</th>
           <th>Type incident</th>
            <th>MODIFIER</th>         
        </tr>
        <?php foreach ($tab as $el) { ?>
<tr>
    <td><?php echo $el['id_agent'] ?></td>
    <td><?php echo $el['date_declaration'] ?></td>
    <td><?php echo $el['motif'] ?></td>
    <td><?php echo $el['commentaire']  ?></td>
    <td><?php echo $el['lieu']  ?></td>
    <td><?php echo $el['type_incident']  ?></td>
    <td><a href="Modifier_declaration_agent.php?code=<?php echo $el['id_agent'] ?>&code2=<?php echo $el['date_declaration'] ?>&code3=<?php echo $el['commentaire'] ?>&code4=<?php echo $el['motif'] ?>" class="btn btn-primary" id="Modifier">Modifier</a></td>



</tr>
<?php } ?>
    </table> 

    </div>
</body>
</html>
