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
            width: 300px;
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
            width: 150px;
            height: 150px;
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
    <div class="agent-card" onclick="window.location.href='profile-agent1.php'">
        <img src="Edouard.jpg" alt="Photo de l'agent">
        <div class="specialty">Spécialité: Finance</div>
    </div>
    <div class="agent-card" onclick="window.location.href='profile-agent2.php'">
        <img src="victor.jpg" alt="Photo de l'agent">
        <div class="specialty">Spécialité: Marketing</div>
    </div>
</body>
</html>
