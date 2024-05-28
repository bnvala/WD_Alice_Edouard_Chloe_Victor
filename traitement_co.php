<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

$identifiant = $_POST['identifiant'];
$motdepasse = $_POST['motdepasse'];

$hashedPassword = password_hash($motdepasse, PASSWORD_DEFAULT);

$sql = "INSERT INTO utilisateurs (identifiant, motdepasse) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $identifiant, $hashedPassword);

if ($stmt->execute()) {
    echo "Inscription réussie !";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
