<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialiser les variables de recherche
$type = isset($_GET['type']) ? trim($_GET['type']) : '';
$description = isset($_GET['description']) ? trim($_GET['description']) : '';
$ville = isset($_GET['ville']) ? trim($_GET['ville']) : '';

// Initialiser la variable des résultats
$searchExecuted = false;
$result = null;

if ($type !== '' || $description !== '' || $ville !== '') {
    // Construire la requête SQL
    $sql = "SELECT * FROM biens WHERE 1=1";
    if ($type !== '') {
        $sql .= " AND type LIKE '%" . $conn->real_escape_string($type) . "%'";
    }
    if ($description !== '') {
        $sql .= " AND description LIKE '%" . $conn->real_escape_string($description) . "%'";
    }
    if ($ville !== '') {
        $sql .= " AND adresse LIKE '%" . $conn->real_escape_string($ville) . "%'";
    }

    $result = $conn->query($sql);
    $searchExecuted = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recherche de biens immobiliers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin: 0 auto;
            width: 60%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="submit"] {
            padding: 8px;
            margin: 5px 0;
            width: calc(100% - 22px);
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: rgb(135,206,250);
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: rgb(135,206,250);
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .thumbnail {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>

<h1>Recherche de biens immobiliers</h1>

<form method="get" action="recherche.php">
    <label for="type">Type:</label>
    <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($type ?? ''); ?>"><br>
    <label for="description">Description:</label>
    <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($description ?? ''); ?>"><br>
    <label for="ville">Ville:</label>
    <input type="text" id="ville" name="ville" value="<?php echo htmlspecialchars($ville ?? ''); ?>"><br>
    <input type="submit" value="Rechercher">
</form>

<?php if ($searchExecuted): ?>
    <h2>Résultats de la recherche</h2>
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Photos</th>
                <th>Description</th>
                <th>Adresse</th>
                <th>Liens</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                    <td><?php echo htmlspecialchars($row["type"]); ?></td>
                    <td><img src="<?php echo htmlspecialchars($row["photos"]); ?>" alt="Photo du bien" class="thumbnail"></td>
                    <td><?php echo htmlspecialchars($row["description"]); ?></td>
                    <td><?php echo htmlspecialchars($row["adresse"]); ?></td>
                    <td><a href="annonce.php?id=<?php echo htmlspecialchars($row["id"]); ?>">Voir l'annonce</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
