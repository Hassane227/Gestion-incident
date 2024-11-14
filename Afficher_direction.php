<?php

require_once("connexion.php");
 $sel=$pdo->prepare("select * from direction");
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
        Liste  des directions
        </h2>
      </div>
      <div class="card-body">
    <table width="100%"   class="table">
        <tr class="entete">
           <th>ID</th>
           <th>service</th>
           <th>Supprimer</th>
           <th>Modifier</th>


        </tr>
        <?php foreach ($tab as $el) { ?>
<tr>
    <td><?php echo $el['id_direction'] ?></td>
    <td><?php echo $el['service'] ?></td>
 

    <td><a href="Supprimer_direction.php?code=<?php echo $el['id_direction'] ?>" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet enseignant ?\nAttention, cela supprimera également les notes associées des étudiants sur sa matière.')">Supprimer</a></td>
    <td><a href="Modifier_direction.php?code=<?php echo $el['id_direction'] ?>" class="btn btn-primary" id="Modifier">Modifier</a></td>



</tr>
<?php } ?>
    </table> 

    </div>
</body>
</html>
