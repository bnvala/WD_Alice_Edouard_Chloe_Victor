<?php
include 'wrapper.php';

//connexion
if (!isset($_SESSION['utilisateur'])) {
    header("Location: form.php");
    exit();
}

//parametre dans l'url ?
if (!isset($_GET['id_rdv'])) {
    echo "ID du rendez-vous manquant dans l'URL.";
    exit();
}

$id_rdv = $_GET['id_rdv'];

include 'db.php';

// Requête pour insérer le rendez-vous effectué dans la table consultations
$sql_insert = "INSERT INTO consultations (id, courriel_client, date, heure, id_agent) 
        SELECT id, courriel_client, date, heure, id_agent FROM rdv WHERE id = ?";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("i", $id_rdv);

if ($stmt_insert->execute()) {
    // Requête pour supprimer la ligne de rendez-vous de la table rdv
    $sql_delete = "DELETE FROM rdv WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id_rdv);

    if ($stmt_delete->execute()) {
        echo "Rendez-vous effectué avec succès et supprimé de la liste des rendez-vous.";
    } else {
        echo "Erreur lors de la suppression du rendez-vous de la liste des rendez-vous.";
    }

    $stmt_delete->close();
} else {
    echo "Erreur lors de l'inscription du rendez-vous effectué.";
}

$stmt_insert->close();
$conn->close();
?>
