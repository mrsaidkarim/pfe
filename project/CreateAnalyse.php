<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Maladie</title>
    <!-- Fontawesome script -->
    <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php
require_once 'connection.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form values
    $nomAnalyse = $_POST['NomAnalyse'];
    $nomMaladie = $_POST['NomMaladie'];
    $NomMedecin = $_POST['nomMedecin'];
    $date = $_POST['Date'];
    $resultat = $_POST['Resultat'];

    $idP = $_GET['id'];

    // Retrieve the IDs of maladie and medecin
    $sqlMaladie = "SELECT IdMaladie FROM Maladie WHERE NomMaladie = :nomMaladie";
    $stmtMaladie = $pdo->prepare($sqlMaladie);
    $stmtMaladie->execute(['nomMaladie' => $nomMaladie]);
    $idMaladie = $stmtMaladie->fetchColumn();

    $sqlMedecin = "SELECT IdMedecin FROM Medecin WHERE NomMedecin = :nomMedecin";
    $stmtMedecin = $pdo->prepare($sqlMedecin);
    $stmtMedecin->execute(['nomMedecin' => $nomMedecin]);
    $idMedecin = $stmtMedecin->fetchColumn();

    // Prepare the INSERT query
    $sql = "INSERT INTO Analyse (NomAnalyse, DateAnalyse, Resultat)
            VALUES (:NomAnalyse, :date, :Resultat)";
    $stmt = $pdo->prepare($sql);

    // Execute the INSERT query with the form values
    $stmt->execute([
        'NomAnalyse' => $nomAnalyse,
        'date' => $date,
        'Resultat' => $resultat
    ]);

    // Retrieve the ID of the newly inserted analysis
    $sqlAnalyse = "SELECT IdAnalyse FROM Analyse WHERE NomAnalyse = :NomAnalyse";
    $stmtAnalyse = $pdo->prepare($sqlAnalyse);
    $stmtAnalyse->execute(['NomAnalyse' => $nomAnalyse]);
    $idAnalyse = $stmtAnalyse->fetchColumn();

    // Insert the relationship between maladie and analyse into the MaladieAnalyse table
    $sql2 = "INSERT INTO MaladieAnalyse (IdMaladie, IdAnalyse)
            VALUES (:IdMaladie, :IdAnalyse)";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([
        'IdMaladie' => $idMaladie,
        'IdAnalyse' => $idAnalyse
    ]);

    // Redirect to the analysis list page
    header("Location: indexAnalyse.php?id=" . $_GET['id']);
    exit();
}
?>


<div class="page">
    <!-- User profile -->
    <div class="content">
        <!-- Form -->
        <div class="container my-5">
            <fieldset class="row border">
                <div class="titre">
                    <h1>Ajouter une analyse</h1>
                </div>

                <form method="post">
                    <div class="formul">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nom :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="NomAnalyse" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <input type="hidden" name="IdMaladie">
                            <label class="col-sm-3 col-form-label">Nom de la maladie :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="NomMaladie" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <input type="hidden" name="IdMedecin">
                            <label class="col-sm-3 col-form-label">Nom du médecin :</label>
                            <div class="col-sm-6">
                                <select id="medecinSelect" class="form-select" style="width: 100%;" name="nomMedecin">
                                    <?php
                                    $qr = "SELECT * FROM Medecin";
                                    $stmt = $pdo->prepare($qr);
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($rows as $row) {
                                        echo "<option value='" . $row['NomMedecin'] . "'" . ">" . $row['NomMedecin'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Date :</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" name="Date" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Résultat :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="Resultat" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="offset-sm-3 col-sm-3 d-grid">
                                <button type="submit" class="btn" style="background-color:#3b999c; color:#ffff">Ajouter</button>
                            </div>

                            <div class="col-sm-3 d-grid">
                                <a class="btn" style="background-color:#ffff; color:#3f9497" href="indexAnalyse.php?id=<?php echo $_GET['id']; ?>" role="button">Annuler</a>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>
<script src="index.js"></script>
</body>
</html>