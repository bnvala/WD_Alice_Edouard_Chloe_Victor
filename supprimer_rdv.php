<?php
// Vérifier si l'identifiant du rendez-vous est passé en paramètre d'URL
if (!isset($_GET['id'])) {
    echo "Identifiant du rendez-vous manquant.";
    exit();
}

$id_rdv = $_GET['id'];

// Connexion à la base de données (supposons que vous ayez déjà une connexion dans wrapper.php)
include 'db.php';

// Requête pour supprimer le rendez-vous de la base de données
$sql = "DELETE FROM rdv WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_rdv);
$stmt->execute();

// Redirection vers la page de liste des rendez-vous
header("Location: rdv_agent.php");
exit();
?>
