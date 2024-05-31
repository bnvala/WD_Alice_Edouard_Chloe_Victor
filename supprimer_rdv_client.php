
<?php
// Vérifier si l'ID du rendez-vous est passé en paramètre d'URL
if (!isset($_GET['id_rdv'])) {
    echo "ID du rendez-vous manquant dans l'URL.";
    exit();
}

$id_rdv = $_GET['id_rdv'];

if (!isset($_GET['id_rdv'])) {
    echo "ID du rendez-vous manquant dans l'URLE.";
    exit();
}

$id_rdv = urldecode($_GET['id_rdv']);


// Connexion à la base de données (supposons que vous ayez déjà une connexion dans wrapper.php)
include 'db.php';

// Requête pour supprimer le rendez-vous de la table rdv
$sql = "DELETE FROM rdv WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_rdv);

if ($stmt->execute()) {
    echo "Le rendez-vous a été supprimé avec succès.";
} else {
    echo "Erreur lors de la suppression du rendez-vous.";
}

// Fermer le statement et la connexion
$stmt->close();
$conn->close();
?>
