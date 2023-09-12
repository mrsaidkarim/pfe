<?php
require "connection.php";

try {
    // Vérification de la méthode de requête HTTP
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Vérification de la présence du paramètre "deleteid"
        if (isset($_GET['deleteid'])) {
            $id = $_GET['deleteid'];
            $get = "SELECT Email FROM Medecin WHERE IdMedecin = :id";
            $stmt = $pdo->prepare($get);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $email = $stmt->fetch(PDO::FETCH_ASSOC)['Email'];

            // Requête de suppression préparée
            $sql1 = "DELETE FROM Medecin WHERE IdMedecin = :id";
            $stmt = $pdo->prepare($sql1);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $sql2 = "DELETE FROM Utilisateur WHERE Email = :email";
            $stmt = $pdo->prepare($sql2);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Exécution de la requête
            if ($stmt->rowCount() > 0) {
                echo "Enregistrement supprimé avec succès.";
            } else {
                echo "Aucun enregistrement trouvé avec l'ID spécifié.";
            }
        }
    }

    // Redirection vers la page d'index
    header("location: indexMedecin.php");
    exit;
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
