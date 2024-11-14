<?php

require_once("connexion.php");
$code = $_GET['code'];

 $sel=$pdo->prepare("select agent.id_agent ,agent.nom,agent.prenom,agent.email,agent.role,direction.service
  from agent 
  INNER JOIN direction ON agent.id_direction = direction.id_direction
  where id_agent = $code ");
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
    
</style>


</head>
<body>
<?php include "interface_informaticien.php"; ?>

<div class="justifier">
<div >
      <div>
        <h2 align="center">
        Information de l'agent
        </h2>
      </div>
      <div class="card-body">
    <table width="100%"   class="table">
        <tr class="entete">
           <th>ID</th>
           <th>NOM</th>
           <th>PRENOM</th>
           <th>EMAIL</th>
           <th>service</th>
                
        </tr>
        <?php foreach ($tab as $el) { ?>
<tr>
    <td><?php echo $el['id_agent'] ?></td>
    <td><?php echo $el['nom'] ?></td>
    <td><?php echo $el['prenom'] ?></td>
    <td><?php echo $el['email']  ?></td>
    <td><?php echo $el['service']  ?></td>


</tr>
<?php } ?>
    </table> 

    </div>
</body>
</html>
