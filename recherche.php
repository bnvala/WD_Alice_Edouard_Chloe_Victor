<?php
// mdp id bdd
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";
// connexion bdd
$conn = new mysqli($servername, $username, $password, $dbname);
// verif de connexion bdd
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// affichage de l'entete 
include 'wrapper.php';
// critère de recherche (type de bien, prix, descrpition, ville)
$type = isset($_GET['type']) ? trim($_GET['type']) : '';
$description = isset($_GET['description']) ? trim($_GET['description']) : '';
$ville = isset($_GET['ville']) ? trim($_GET['ville']) : '';
$prix_min = isset($_GET['prix_min']) ? trim($_GET['prix_min']) : '';
$prix_max = isset($_GET['prix_max']) ? trim($_GET['prix_max']) : '';
// initialisation de variable 
$searchExecuted = false;
$result = null;

// recherche en fonction des critères en php 
if ($type !== '' || $description !== '' || $ville !== '' || $prix_min !== '' || $prix_max !== '') {
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
    if ($prix_min !== '') {
        $sql .= " AND prix >= " . (float)$prix_min;
    }
    if ($prix_max !== '') {
        $sql .= " AND prix <= " . (float)$prix_max;
    }

    $result = $conn->query($sql);
    $searchExecuted = true;
}
?>
<!--page html -->
<!DOCTYPE html>
<html>
<head>
    <title>Recherche de biens immobiliers</title>
    <link rel="stylesheet" type="text/css" href="styles_recherches.css">
</head>
<body>
<!-- contenu du corp de la page html -->
<h1>Recherche de biens immobiliers</h1>

<form method="get" action="recherche.php">
    <label for="type">Type:</label>
    <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($type ?? ''); ?>"><br>
    <label for="description">Description:</label>
    <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($description ?? ''); ?>"><br>
    <label for="ville">Ville:</label>
    <input type="text" id="ville" name="ville" value="<?php echo htmlspecialchars($ville ?? ''); ?>"><br>
    <label for="prix_min">Prix minimum:</label>
    <input type="text" id="prix_min" name="prix_min" value="<?php echo htmlspecialchars($prix_min ?? ''); ?>"><br>
    <label for="prix_max">Prix maximum:</label>
    <input type="text" id="prix_max" name="prix_max" value="<?php echo htmlspecialchars($prix_max ?? ''); ?>"><br>
    <input type="submit" value="Rechercher">
</form>

<?php if ($searchExecuted): ?>
       <!-- affichage du resultat en php  -->
    <h2>Résultats de la recherche</h2>
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Photos</th>
                <th>Description</th>
                <th>Adresse</th>
                <th>Prix</th>
                <th>Liens</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                    <td><?php echo htmlspecialchars($row["type"]); ?></td>
                    <td><img src="<?php echo htmlspecialchars($row["photos"]); ?>" alt="Photo du bien" class="thumbnail"></td>
                    <td><?php echo htmlspecialchars($row["description"]); ?></td>
                    <td><?php echo htmlspecialchars($row["adresse"]); ?></td>
                    <td><?php echo htmlspecialchars($row["prix"]); ?> €</td>
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
