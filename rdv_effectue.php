<?php
include 'wrapper.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: form.php");
    exit();
}

// Vérifier si l'ID du rendez-vous est passé en paramètre d'URL
if (!isset($_GET['id_rdv'])) {
    echo "ID du rendez-vous manquant dans l'URL.";
    exit();
}

$id_rdv = $_GET['id_rdv'];

// Connexion à la base de données (supposons que vous ayez déjà une connexion dans wrapper.php)
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

    // Fermer le statement de suppression
    $stmt_delete->close();
} else {
    echo "Erreur lors de l'inscription du rendez-vous effectué.";
}

// Fermer le statement d'insertion et la connexion
$stmt_insert->close();
$conn->close();
?>
