<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form action="traitement_inscription.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="adresse">Adresse :</label>
        <textarea id="adresse" name="adresse" rows="4" required></textarea><br><br>

        <label for="courriel">Identifiant :</label>
        <input type="email" id="courriel" name="courriel" required><br><br>

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" id="motdepasse" name="motdepasse" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
