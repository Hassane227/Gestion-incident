<?php
require_once("connexion.php");

if (isset($_GET['code'])&&isset($_GET['code2'])&&isset($_GET['code3'])&&isset($_GET['code4'])) {
    $id_agent_ancien = $_GET['code'];
    $date_affectation =$_GET['code2'];
    $priorite_ancien = $_GET['code3'];
    $statut_ancien=$_GET['code4'];
    $code_incident = $_GET['code5'];


    try {
        $pdo->beginTransaction();

        $supprimerColonneOccurrence = $pdo->prepare("UPDATE affecter SET id_agent = NULL, id_incident = NULL WHERE id_agent = :id_agent and 
        id_incident =:code_incident and date_affectation= :date_affectation and statut_affectation = :statut ");
        $supprimerColonneOccurrence->bindParam(':id_agent', $id_agent_ancien);
        $supprimerColonneOccurrence->bindParam(':code_incident', $code_incident);
        $supprimerColonneOccurrence->bindParam(':date_affectation',$date_affectation );
        $supprimerColonneOccurrence->bindParam(':statut',$statut_ancien);
        $supprimerColonneOccurrence->execute();

        // Enfin, supprimer l'informaticien lui-même
        $supprimerEnseignant = $pdo->prepare("DELETE FROM affecter WHERE  date_affectation  ='$date_affectation' and statut_affectation  ='$statut_ancien' and priorite  = '$priorite_ancien'");
        $supprimerEnseignant->execute();

        $pdo->commit();
        require_once("Afficher_affectation_Admi.php");
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "Code d'informaticien non spécifié.";
}

?>
