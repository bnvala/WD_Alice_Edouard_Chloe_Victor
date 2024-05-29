<?php
include 'db.php';
include 'db.php';
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
use Twilio\Rest\Client;
$sid = 'AC44e06cd346b75c977839be284616bb57';
$token = 'dcd8dd6e4199d34f525a1ef51494234e';
$client = new Client($sid, $token);
$id_agent = $_GET['id_agent'];
$jour = $_GET['jour'];
$creneau = $_GET['creneau'];
$column = $creneau == 'AM' ? 'AM' : 'PM';
$sql = "UPDATE dispo_agents SET $column = 0 WHERE id_agent = $id_agent AND jour = '$jour'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Votre rendez-vous a été réservé. Vous recevrez une confirmation par SMS ou courriel.');</script>";
    echo "<script>window.location.href = 'profil-agent.php?id=$id_agent';</script>";
    $client->messages->create(
        '+33 6 42 13 10 99',
        array(
            'from' => '+1 681 581 5884', 
            'body' => 'Votre rendez-vous a été confirmé.'
        )
    )
} else {
    echo "Erreur lors de la réservation : " . $conn->error;
}

$conn->close();
?>


