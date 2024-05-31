<?php
include 'wrapper.php';
// Vérifier si l'ID du rendez-vous est passé en paramètre d'URL
if (!isset($_GET['id_rdv'])) {
    echo "ID du rendez-vous manquant dans l'URL.";
    exit();
}

$id_rdv = $_GET['id_rdv'];

// Connexion à la base de données (supposons que vous ayez déjà une connexion dans wrapper.php)
include 'db.php';

// Démarrer une transaction
$conn->begin_transaction();

// Requête pour supprimer le rendez-vous de la table rdv
$sql_delete_rdv = "DELETE FROM rdv WHERE id = ?";
$stmt_delete_rdv = $conn->prepare($sql_delete_rdv);
$stmt_delete_rdv->bind_param("i", $id_rdv);

if ($stmt_delete_rdv->execute()) {
    // Requête pour mettre à jour la disponibilité de l'agent dans la table dispo_agents_heure_par_heure
    $sql_update_dispo = "UPDATE dispo_agents_heure_par_heure SET dispo = 1, id_rdv = NULL WHERE id_rdv = ?";
    $stmt_update_dispo = $conn->prepare($sql_update_dispo);
    $stmt_update_dispo->bind_param("i", $id_rdv);

    if ($stmt_update_dispo->execute()) {
        // Si les deux opérations réussissent, commit la transaction
        $conn->commit();
        echo "Le rendez-vous a été supprimé avec succès et la disponibilité de l'agent a été mise à jour.";
    } else {
        // Si la mise à jour échoue, rollback la transaction
        $conn->rollback();
        echo "Erreur lors de la mise à jour de la disponibilité de l'agent.";
    }
} else {
    // Si la suppression échoue, rollback la transaction
    $conn->rollback();
    echo "Erreur lors de la suppression du rendez-vous.";
}

// Fermer les statements et la connexion
$stmt_delete_rdv->close();
$stmt_update_dispo->close();
$conn->close();
?>
