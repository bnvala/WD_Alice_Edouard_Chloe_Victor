<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification Réussie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .auth-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 20px;
            text-align: center;
        }
        .auth-header {
            background-color: #4CAF50; /* Vert */
            color: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            font-size: 18px;
            font-weight: bold;
        }
        .auth-body {
            padding: 20px;
            font-size: 14px;
            color: #333;
        }
        .auth-body p {
            margin: 10px 0;
        }
        .auth-footer {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 0 0 10px 10px;
        }
        .auth-footer button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 5px;
        }
        .auth-footer button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            Authentification Réussie
        </div>
        <div class="auth-body">
            <p>Votre authentification a été effectuée avec succès.</p>
            <p>Vous pouvez maintenant retourner à l'accueil.</p>
        </div>
        <div class="auth-footer">
            <form action="accueil.php">
                <button type="submit">Retourner à l'accueil</button>
            </form>
        </div>
    </div>
</body>
</html>
