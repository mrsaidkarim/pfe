<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pfe";

try {
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Configuration des options PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérification de la méthode de requête HTTP
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Vérification de la présence du paramètre "deleteid"
        if (isset($_GET['deleteid'])) {
            $id = $_GET['deleteid'];

            // Requête de suppression préparée
            $sql = "DELETE FROM patient WHERE idPatient=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);

            // Exécution de la requête
            if ($stmt->execute()) {
                echo "Enregistrement supprimé avec succès.";
            } else {
                echo "Erreur lors de la suppression de l'enregistrement.";
            }
        }
    }

    // Redirection vers la page d'index
    header("location: /PFE/indexPatient.php");
    exit;
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
