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
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$courriel = $_POST['courriel'];
$motdepasse = $_POST['motdepasse'];

// Hasher le mot de passe
$hashedPassword = password_hash($motdepasse, PASSWORD_DEFAULT);

// Préparer la requête SQL
$sql = "INSERT INTO client (nom, prenom, adresse, courriel, mot_de_passe) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Vérifier la préparation de la requête
if ($stmt === false) {
    die("Erreur de préparation de la requête: " . $conn->error);
}

// Binder les paramètres
if (!$stmt->bind_param("sssss", $nom, $prenom, $adresse, $courriel, $hashedPassword)) {
    die("Erreur lors du binding des paramètres: " . $stmt->error);
}

// Exécuter la requête
if ($stmt->execute()) {
    echo "Inscription réussie !";
} else {
    echo "Erreur: " . $stmt->error;
}

// Fermer la requête et la connexion
$stmt->close();
$conn->close();
?>
