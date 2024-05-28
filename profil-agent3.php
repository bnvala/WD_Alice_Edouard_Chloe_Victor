<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Profile</title>
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
        .profile-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 700px;
            padding: 20px;
        }
        .profile-card .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-card .header img {
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-card h2 {
            margin-top: 0;
        }
        .profile-card .info {
            margin-bottom: 20px;
        }
        .profile-card .info div {
            margin: 5px 0;
        }
        .schedule {
            margin-bottom: 20px;
            text-align: center;
        }
        .schedule table {
            width: 100%;
            border-collapse: collapse;
        }
        .schedule th, .schedule td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .schedule th {
            background-color: #f4f4f4;
        }
        .unavailable {
            background-color: #000;
            color: #fff;
        }
        .buttons {
            text-align: center;
        }
        .buttons button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .buttons button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="profile-card">
        <div class="header">
            <img src="photo-agent3.jpg" alt="Photo de l'agent" class="photo-agent" width="150" height="150">
            <div class="info">
                <div><strong>Name:</strong> Alice COUDERT</div>
                <div><strong>Email:</strong> alice.coudert@edu.ece.fr</div>
                <div><strong>Téléphone:</strong> +1234567890</div>
            </div>
        </div>
        <div class="schedule">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>AM</th>
                        <td></td>
                        <td class="unavailable"></td>
                        <td></td>
                        <td></td>
                        <td class="unavailable"></td>
                    </tr>
                    <tr>
                        <th>PM</th>
                        <td></td>
                        <td></td>
                        <td class="unavailable"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="buttons">
            <button onclick="alert('Prendre RDV avec notre conseiller')">Prendre un RDV</button>
            <button onclick="alert('Rentrer en communication avec notre agent')">Communiquer</button>
            <button onclick="alert('Voir CV')">Voir le CV</button>
        </div>
    </div>
</body>
</html>
