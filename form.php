<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
</head>
<body>
    <h2>Formulaire d'Inscription</h2>
    <form action="traitement_co.php" method="post">
        <label for="identifiant">Identifiant :</label>
        <input type="text" id="identifiant" name="identifiant" required><br><br>

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" id="motdepasse" name="motdepasse" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
