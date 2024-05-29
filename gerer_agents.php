<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les agents immobiliers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }
        .agent-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            margin: 20px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .agent-card:hover {
            transform: scale(1.05);
        }
        .agent-card img {
            border-radius: 50%;
            width: 120px;
            height: 150px;
        }
        .agent-card.large img {
            width: 150px;
            height: 150px;
        }
        .agent-card .specialty {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }
        .delete-button, .edit-button {
            background-color: #ff3333;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .delete-button:hover, .edit-button:hover {
            background-color: #cc0000;
        }
        .add-button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .add-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <button class="add-button" onclick="window.location.href='ajouter-agent.php'">Ajouter un agent</button>
    <h1>Nos Agents</h1>
    <?php
    include 'db.php';

    // Traitement de la soumission du formulaire de suppression
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_agent'])) {
        // Récupérer l'ID de l'agent à supprimer
        $agent_id = $_POST['agent_id'];
        
        // Requête SQL pour supprimer l'agent de la base de données
        $sql_delete = "DELETE FROM agent WHERE id_agent = $agent_id";

        // Exécution de la requête
        if ($conn->query($sql_delete) === TRUE) {
            echo "Agent supprimé avec succès";
        } else {
            echo "Erreur lors de la suppression de l'agent: " . $conn->error;
        }
    }

    // Récupération des agents depuis la base de données
    $sql = "SELECT * FROM agent";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $agent_card_class = ($row["id_agent"] >= 5 && $row["id_agent"] <= 20) ? "agent-card large" : "agent-card";
            echo '<div class="' . $agent_card_class . '" onclick="window.location.href=\'profil-agent.php?id=' . $row["id_agent"] . '\'">';
            echo '<img src="photos_agents/' . $row["photo"] . '" alt="Photo de l\'agent">';
            echo '<div class="specialty">Spécialité: ' . $row["specialite"] . '</div>';
            // Ajout des boutons Supprimer et Modifier avec des formulaires distincts
            echo '<form method="post">';
            echo '<input type="hidden" name="agent_id" value="' . $row["id_agent"] . '">';
            echo '<button type="submit" name="delete_agent" class="delete-button">Supprimer</button>';
            echo '</form>';
            echo '<form action="modifier-agent.php" method="post">';
            echo '<input type="hidden" name="agent_id" value="' . $row["id_agent"] . '">';
            echo '<button type="submit" name="edit_agent" class="edit-button">Modifier</button>';
            echo '</form>';
            echo '</div>';
        }
    } else {
        echo "Aucun agent trouvé";
    }

    $conn->close();
    ?>
</body>
</html>
