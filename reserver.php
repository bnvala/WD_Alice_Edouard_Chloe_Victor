<?php
include 'db.php';

$id_agent = $_GET['id_agent'];
$jour = $_GET['jour'];
$heure = $_GET['heure'];

$sql = "UPDATE dispo_agents_heure_par_heure SET dispo = 0 WHERE id_agent = $id_agent AND jour = '$jour' AND heure = '$heure'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Votre rendez-vous a été réservé. Vous recevrez une confirmation par SMS ou courriel.');</script>";
    echo "<script>window.location.href = 'profil-agent.php?id=$id_agent';</script>";
} else {
    echo "Erreur lors de la réservation : " . $conn->error;
}

$conn->close();
?>
