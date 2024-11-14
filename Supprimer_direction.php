<?php
require_once("connexion.php");

if (isset($_GET['code'])) {
    $codeEnseignant = $_GET['code'];

    try {
        $pdo->beginTransaction();

        $supprimerColonneOccurrence = $pdo->prepare("UPDATE agent SET id_direction = NULL WHERE id_direction = :codeEnseignant");
        $supprimerColonneOccurrence->bindParam(':codeEnseignant', $codeEnseignant);
        $supprimerColonneOccurrence->execute();

        // Enfin, supprimer l'informaticien lui-même
        $supprimerEnseignant = $pdo->prepare("DELETE FROM direction WHERE id_direction = :codeEnseignant");
        $supprimerEnseignant->bindParam(':codeEnseignant', $codeEnseignant);
        $supprimerEnseignant->execute();

        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "Code d'informaticien non spécifié.";
}
require_once("afficher_direction.php");
?>
