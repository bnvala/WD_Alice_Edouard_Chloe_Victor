<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

// Connexion a la bdd
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_agent = $_POST['id_agent'];
    $id_client = $_POST['id_client'];
    $message = $_POST['message'];

    // insertion de la communication dans la bdd ==> on entre le message pour le ressortir qu destinatire 
    $stmt = $conn->prepare("INSERT INTO communication (ID_client, ID_agent, message, envoyeur) VALUES (?, ?, ?, 'agent')");
    $stmt->bind_param("iis", $id_client, $id_agent, $message);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s') 
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => $stmt->error
        ]);
    }

    $stmt->close();
}

$conn->close();
?>
