<?php

require_once("connexion.php");
 $sel=$pdo->prepare("select agent.id_agent ,agent.nom,agent.prenom,agent.email,agent.role,direction.service
  from agent 
  INNER JOIN direction ON agent.id_direction = direction.id_direction
  where role = 'Informaticien' or role ='Admin'");
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

<?php include 'Admin.php'; ?>

<div class="justifier">
<div >
      <div>
        <h2 align="center">
        Liste  des informaticiens
        </h2>
      </div>
      <div class="card-body">
    <table width="100%"   class="table">
        <tr class="entete">
           <th>ID</th>
           <th>NOM</th>
           <th>PRENOM</th>
           <th>EMAIL</th>
           <th>Rôle</th>
           <th>service</th>
           <th>SUPPRIMER</th>
            <th>MODIFIER</th>         
        </tr>
        <?php foreach ($tab as $el) { ?>
<tr>
    <td><?php echo $el['id_agent'] ?></td>
    <td><?php echo $el['nom'] ?></td>
    <td><?php echo $el['prenom'] ?></td>
    <td><?php echo $el['email']  ?></td>
    <td><?php echo $el['role']  ?></td>
    <td><?php echo $el['service']  ?></td>

    <td><a href="Supprimer_informaticien.php?code=<?php echo $el['id_agent'] ?>" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ')">Supprimer</a></td>
    <td><a href="Modifier_informaticien.php?code=<?php echo $el['id_agent'] ?>" class="btn btn-primary" id="Modifier">Modifier</a></td>



</tr>
<?php } ?>
    </table> 

    </div>
</body>
</html>
