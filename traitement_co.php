<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}
$courriel = $_POST['courriel'];
$motdepasse = $_POST['motdepasse'];
$sql = "SELECT * FROM client WHERE courriel = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $courriel);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($motdepasse, $row['mot_de_passe'])) {
        // Connexion réussie, rediriger vers la page Mon Compte
        $_SESSION['utilisateur'] = $row; // Stocker les informations de l'utilisateur dans la session
        echo "<script>window.location.href = 'mon_compte.php';</script>";
        exit;
    } else {
        // Identifiant ou mot de passe incorrect
        // Supprimez l'echo ou commentez-le pour éviter toute sortie HTML avant l'appel à header()
        // echo "Votre identifiant ou votre mot de passe est incorrect.";
        // Vous pouvez également utiliser une redirection JavaScript pour afficher ce message
        //echo "<script>alert('Votre identifiant ou votre mot de passe est incorrect.'); window.location.href = 'form.php';</script>";
        exit;
    }
} else {
    // Identifiant ou mot de passe incorrect
    // Supprimez l'echo ou commentez-le pour éviter toute sortie HTML avant l'appel à header()
    // echo "Votre identifiant ou votre mot de passe est incorrect.";
    // Vous pouvez également utiliser une redirection JavaScript pour afficher ce message
    //echo "<script>alert('Votre identifiant ou votre mot de passe est incorrect.'); window.location.href = 'form.php';</script>";
    exit;
}
$stmt->close();
$conn->close();
?>
