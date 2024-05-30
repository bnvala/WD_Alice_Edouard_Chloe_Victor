<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Agents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }
        .category-banner {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .agent-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
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
        .agent-card .initials {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .agent-card .name {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .agent-card .specialty {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Nos Agents</h1>
    
    <div class="category-banner">Nos Agents Spécialisés en Immobilier Résidentiel</div>
    <div class="agent-container">
        <?php
        include 'db.php';
        include 'wrapper.php';
        $sql = "SELECT * FROM agent WHERE specialite = 'Immobilier résidentiel'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $initial = strtoupper(substr($row["prenom"], 0, 1)). '.' . $name =  ucfirst(strtolower($row["nom"]));
                $agent_card_class = ($row["id_agent"] >= 5 && $row["id_agent"] <= 20) ? "agent-card large" : "agent-card";
                echo '<div class="' . $agent_card_class . '" onclick="window.location.href=\'profil-agent.php?id=' . $row["id_agent"] . '\'">';
                echo '<div class="initials">' . $initial . '</div>';
                echo '<div class="name">' . $name . '</div>';
                echo '<img src="photos_agents/' . $row["photo"] . '" alt="Photo de l\'agent">';
                echo '<div class="specialty">' . $row["specialite"] . '</div>';
                echo '</div>';
            }
        } else {
            echo "No agents found";
        }
        ?>
    </div>

    <!-- Catégorie Immobilier Commercial -->
    <div class="category-banner">Nos Agents Spécialisés en Immobilier Commercial</div>
    <div class="agent-container">
        <?php
        $sql = "SELECT * FROM agent WHERE specialite = 'Immobilier commercial'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $initial = strtoupper(substr($row["prenom"], 0, 1)). '.' . $name =  ucfirst(strtolower($row["nom"]));
                $agent_card_class = ($row["id_agent"] >= 5 && $row["id_agent"] <= 20) ? "agent-card large" : "agent-card";
                echo '<div class="' . $agent_card_class . '" onclick="window.location.href=\'profil-agent.php?id=' . $row["id_agent"] . '\'">';
                echo '<div class="initials">' . $initial . '</div>';
                echo '<div class="name">' . $name . '</div>';
                echo '<img src="photos_agents/' . $row["photo"] . '" alt="Photo de l\'agent">';
                echo '<div class="specialty">' . $row["specialite"] . '</div>';
                echo '</div>';
            }
        } else {
            echo "No agents found";
        }
        ?>
    </div>

    <!-- Catégorie Location -->
    <div class="category-banner">Nos Agents Spécialisés en Location</div>
    <div class="agent-container">
        <?php
        $sql = "SELECT * FROM agent WHERE specialite = 'Location'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $initial = strtoupper(substr($row["prenom"], 0, 1)). '.' . $name =  ucfirst(strtolower($row["nom"]));
                $agent_card_class = ($row["id_agent"] >= 5 && $row["id_agent"] <= 20) ? "agent-card large" : "agent-card";
                echo '<div class="' . $agent_card_class . '" onclick="window.location.href=\'profil-agent.php?id=' . $row["id_agent"] . '\'">';
                echo '<div class="initials">' . $initial . '</div>';
                echo '<div class="name">' . $name . '</div>';
                echo '<img src="photos_agents/' . $row["photo"] . '" alt="Photo de l\'agent">';
                echo '<div class="specialty">' . $row["specialite"] . '</div>';
                echo '</div>';
            }
        } else {
            echo "No agents found";
        }
        ?>
    </div>

    <div class="category-banner">Nos Agents Spécialisés en Terrain</div>
    <div class="agent-container">
        <?php
        $sql = "SELECT * FROM agent WHERE specialite = 'Terrain'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $initial = strtoupper(substr($row["prenom"], 0,));
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $initial = strtoupper(substr($row["prenom"], 0, 1)). '.' . $name =  ucfirst(strtolower($row["nom"]));
                $agent_card_class = ($row["id_agent"] >= 5 && $row["id_agent"] <= 20) ? "agent-card large" : "agent-card";
                echo '<div class="' . $agent_card_class . '" onclick="window.location.href=\'profil-agent.php?id=' . $row["id_agent"] . '\'">';
                echo '<div class="initials">' . $initial . '</div>';
                echo '<div class="name">' . $name . '</div>';
                echo '<img src="photos_agents/' . $row["photo"] . '" alt="Photo de l\'agent">';
                echo '<div class="specialty">' . $row["specialite"] . '</div>';
                echo '</div>';
            }
        }
    }
        } else {
            echo "No agents found";
        }
        $conn->close();
        ?>
    </div>
    </body>
</html>