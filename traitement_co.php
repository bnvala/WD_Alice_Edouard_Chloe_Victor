<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$courriel = $_POST['courriel'];
$motdepasse = $_POST['motdepasse'];

// Vérifier si l'utilisateur existe dans la base de données
$sql = "SELECT mot_de_passe FROM client WHERE courriel = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $courriel);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // L'utilisateur existe, vérifier le mot de passe
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    if (password_verify($motdepasse, $hashedPassword)) {
        // Mot de passe correct
        echo "Connexion réussie !";
    } else {
        // Mot de passe incorrect
        echo "Votre identifiant ou votre mot de passe est incorrect.";
    }
} else {
    // L'utilisateur n'existe pas
    echo "Votre identifiant ou votre mot de passe est incorrect.";
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
