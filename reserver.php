<?php
session_start();
include 'db.php';

$id_agent = $_GET['id_agent'];
$jour = $_GET['jour'];
$heure = $_GET['heure'];

// Ici, vous pouvez utiliser $_SESSION['utilisateur']['id'] pour obtenir l'ID de l'utilisateur connecté

// Assurez-vous d'utiliser des requêtes préparées pour éviter les injections SQL
$sql = "UPDATE dispo_agents_heure_par_heure SET dispo = 0 WHERE id_agent = ? AND jour = ? AND heure = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $id_agent, $jour, $heure);

if ($stmt->execute()) {
    echo "<script>alert('Votre rendez-vous a été réservé. Vous recevrez une confirmation par SMS ou courriel.');</script>";
    // Redirection vers une page de paiement avec l'ID du client
    header("Location: paiement.php?id_client=" . $_SESSION['utilisateur']['id']);
    exit();
} else {
    echo "Erreur lors de la réservation : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
