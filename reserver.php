<?php
include 'db.php';
$id_agent = $_GET['id_agent'];
$jour = $_GET['jour'];
$creneau = $_GET['creneau'];
$column = $creneau == 'AM' ? 'AM' : 'PM';
$sql = "UPDATE dispo_agents SET $column = 0 WHERE id_agent = $id_agent AND jour = '$jour'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Votre rendez-vous a été réservé. Vous recevrez une confirmation par SMS ou courriel.');</script>";
    echo "<script>window.location.href = 'profil-agent.php?id=$id_agent';</script>";
} else {
    echo "Erreur lors de la réservation : " . $conn->error;
}

$conn->close();
?>
