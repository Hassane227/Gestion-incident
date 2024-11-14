<?php
require_once("connexion.php");

if (isset($_GET['code'])&&isset($_GET['code2'])&&isset($_GET['code3'])&&isset($_GET['code4'])) {
    $code_agent = $_GET['code'];
    $code_incident=$_GET['code2'];
    $date_declaration=$_GET['code3'];
    $motif = $_GET['code4'];


    try {
        $pdo->beginTransaction();

        $supprimerColonneOccurrence = $pdo->prepare("UPDATE declaration SET id_agent = NULL, id_incident = NULL WHERE id_agent = :codeEnseignant and 
        id_incident =:code_incident and date_declaration= :date_declaration and motif = :motif ");
        $supprimerColonneOccurrence->bindParam(':codeEnseignant', $code_agent);
        $supprimerColonneOccurrence->bindParam(':code_incident', $code_incident);
        $supprimerColonneOccurrence->bindParam(':date_declaration', $date_declaration);
        $supprimerColonneOccurrence->bindParam(':motif', $motif);

        $supprimerColonneOccurrence->execute();

        // Enfin, supprimer l'informaticien lui-même
        $supprimerEnseignant = $pdo->prepare("DELETE FROM declaration WHERE date_declaration ='$date_declaration' and motif ='$motif'");
        $supprimerEnseignant->execute();

        $pdo->commit();
        require_once("Afficher_declaration_Admi.php");
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "Code d'informaticien non spécifié.";
}

?>
