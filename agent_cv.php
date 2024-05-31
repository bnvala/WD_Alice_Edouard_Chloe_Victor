<?php
include 'db.php';

header('Content-Type: text/html; charset=utf-8');

$specialities = [
    'residentiel' => 'Expert en transactions immobilières résidentielles, notre agent vous accompagne dans toutes les étapes de votre projet immobilier, de l\'évaluation à la signature.',
    'commercial' => 'Spécialiste de l\'immobilier commercial, notre agent vous aide à trouver le bien idéal et s\'occupe de toutes les démarches administratives.',
    'location' => 'Spécialiste de la location, notre agent vous aide à trouver le bien idéal et s\'occupe de toutes les démarches administratives.',
    'terrain' => 'Expert en transactions de terrains, notre agent vous accompagne dans toutes les étapes de votre projet foncier.'
];

$formations = [
    'Commerce' => [
        'Diplôme en Commerce International',
        'Licence en Commerce et Vente',
        'Master en Gestion Commerciale'
    ],
    'Architecture' => [
        'Diplôme en Architecture d\'Intérieur',
        'Licence en Design Architectural',
        'Master en Architecture et Urbanisme'
    ],
    'Immobilier' => [
        'Diplôme en Gestion Immobilière',
        'Licence en Droit Immobilier',
        'Master en Sciences Immobilières'
    ]
];

$experiences = [
    'Commerce' => [
        '5 ans d\'expérience en tant que consultant commercial.',
        '3 ans d\'expérience en gestion de ventes immobilières.',
        '7 ans d\'expérience en développement de réseaux commerciaux.'
    ],
    'Architecture' => [
        '4 ans d\'expérience en tant qu\'architecte d\'intérieur.',
        '6 ans d\'expérience en gestion de projets architecturaux.',
        '5 ans d\'expérience en design urbain.'
    ],
    'Immobilier' => [
        '6 ans d\'expérience en gestion de biens immobiliers.',
        '8 ans d\'expérience en conseil immobilier.',
        '5 ans d\'expérience en transactions immobilières.'
    ]
];

$id = $_GET['id'];
$sql = "SELECT * FROM agent WHERE id_agent = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($agent = $result->fetch_assoc()) {
        $id = $agent['id_agent'];

        $speciality = $agent["specialite"];
        $description = isset($specialities[$speciality]) ? $specialities[$speciality] : 'Spécialiste en immobilier, notre agent est à votre service pour tous vos besoins immobiliers.';
        $domain = array_rand($formations);
        $formation = $formations[$domain][array_rand($formations[$domain])];
        $experience = $experiences[$domain][array_rand($experiences[$domain])];
        echo '<div class="profile-card">';
        echo '<div class="header">';
        echo '<img src="photos_agents/' . $agent["photo"] . '" alt="Photo de l\'agent" class="photo-agent" width="120" height="150">';
        echo '<div class="info">';
        echo '<div><strong>Nom:</strong> ' . $agent["prenom"] . ' ' . $agent["nom"] . '</div>';
        echo '<div><strong>Email:</strong> ' . $agent["courriel"] . '</div>';
        echo '<div><strong>Téléphone:</strong> ' . $agent["numero_tel"] . '</div>';
        echo '<div><strong>Spécialité:</strong> ' . $speciality . '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="description">';
        echo '<p>' . $description . '</p>';
        echo '</div>';
        echo '<div class="formation">';
        echo '<h3>Formation</h3>';
        echo '<p>' . $formation . '</p>';
        echo '</div>';
        echo '<div class="experience">';
        echo '<h3>Expérience</h3>';
        echo '<p>' . $experience . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Aucun agent trouvé.</p>';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV des Agents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
        .profile-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1000px;
            padding: 20px;
            margin: 20px 0;
        }
        .profile-card .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-card .header img {
            border-radius: 50%;
            margin-right: 20px;
            width: 120px;
            height: 150px;
            object-fit: cover;
        }
        .profile-card h2 {
            margin-top: 0;
        }
        .profile-card .info div {
            margin: 5px 0;
        }
        .profile-card .info {
            margin-bottom: 20px;
        }
        .profile-card .formation,
        .profile-card .experience {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
</body>
</html>


