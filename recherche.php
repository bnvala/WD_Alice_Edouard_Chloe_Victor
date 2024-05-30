<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include 'wrapper.php';

$type = isset($_GET['type']) ? trim($_GET['type']) : '';
$description = isset($_GET['description']) ? trim($_GET['description']) : '';
$ville = isset($_GET['ville']) ? trim($_GET['ville']) : '';

$searchExecuted = false;
$result = null;

if ($type !== '' || $description !== '' || $ville !== '') {
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
    <link rel="stylesheet" type="text/css" href="styles_recherches.css">
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
                    <td><a href="pages_biens/bien<?php echo htmlspecialchars($row["id"]); ?>.php">Voir l'annonce</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
<?php endif; ?>

<?php if ($type !== ''): ?>
    <h2>Agents Immobiliers Spécialisés</h2>
    <div class="agents">
        <?php
        $sql_agents = "SELECT * FROM agent WHERE specialite LIKE '%" . $conn->real_escape_string($type) . "%'";
        $result_agents = $conn->query($sql_agents);

        if ($result_agents->num_rows > 0) {
            while($row_agents = $result_agents->fetch_assoc()) {
                echo '<div class="agent-card" onclick="window.location.href=\'profil-agent.php?id=' . $row_agents["id_agent"] . '\'">';
                echo '<img src="photos_agents/' . htmlspecialchars($row_agents["photo"]) . '" alt="Photo de l\'agent">';
                echo '<div class="specialty">' . htmlspecialchars($row_agents["nom"]) . '</div>';
                echo '<div class="specialty">' . htmlspecialchars($row_agents["prenom"]) . '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Aucun agent trouvé.</p>";
        }
        ?>
    </div>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>