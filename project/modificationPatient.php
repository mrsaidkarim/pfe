
<?php

// Inclusion du fichier de connexion
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Méthode GET : afficher les données du patient

    if (!isset($_GET["id"])) {
        header("location: indexPatient.php");
        exit;
    }

    $id = $_GET["id"];

    // Lecture de la ligne du patient sélectionné depuis la table de la base de données
    $query = "SELECT * FROM Patient WHERE IdPatient = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location: indexPatient.php");
        exit;
    }

    $nom = $row["NomPatient"];
    $prenom = $row["PrenomPatient"];
    $tele = $row["TelePatient"];
    $adresse = $row["AdressePatient"];
    $email = $row["EmailPatient"];
    $gs = $row["GroupeSanguin"];
    $sexe = $row["Sexe"];
    $age = $row["AgePatient"];
} else {
    // Méthode POST : mettre à jour les données du patient

    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $tele = $_POST["tele"];
    $adresse = $_POST["adresse"];
    $email = $_POST["email"];
    $gs = $_POST["gs"];
    $sexe = $_POST["sexe"];
    $age = $_POST["age"];
do{
    if (empty($id) || empty($nom) || empty($prenom) || empty($tele) || empty($adresse) || empty($email) || empty($gs) || empty($sexe) || empty($age)) {
        $errorMessage = "Tous les champs sont obligatoires";
        break;
    } else {
        $query = "UPDATE Patient SET NomPatient = :nom, PrenomPatient = :prenom, TelePatient = :tele, AdressePatient = :adresse, EmailPatient = :email, GroupeSanguin = :gs, Sexe = :sexe, AgePatient = :age WHERE IdPatient=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':tele', $tele);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gs', $gs);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();

        if ($result) {
            $successMessage = "Patient mis à jour avec succès";
            header("location: indexInfo.php?id=$id");
            exit;
        } else {
            $errorMessage = "Erreur lors de la mise à jour du Patient : " . $stmt->errorInfo()[2];
        }
    }
   }while(false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Patient</title>
      <!-- fontawesome script -->
      <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
    <!--BOOSTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 <!--css-->
<link rel="stylesheet" href="css/index.css">
</head>
<body>
   <div class="page">
      <!--user profile-->
      
           <!--formulaire-->

            <div class="container my-5">
               <fieldset class="row border">
               <div class="titre">
               <h1>Modifier patient</h1>
               </div>
               <?php
               if(!empty($errorMessage)){
                  echo"
                  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>ATTENTION! $errorMessage</strong>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
                  ";
               }
               ?>


               <form method="post">
                  <input type="hidden" name="id" value="<?php echo $id ?>">

                  

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Nom :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control"  name="nom" value="<?php echo $nom ?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Prénom :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="prenom" value="<?php echo $prenom?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Numero de téléphone :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="tele" value="<?php echo $tele?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Adresse :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="adresse" value="<?php echo $adresse?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Email :</label>
                     <div class="col-sm-6">
                        <input type="email" class="form-control" name="email" value="<?php echo $email?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Groupe sanguin :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="gs" value="<?php echo $gs?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Sexe :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="sexe" value="<?php echo $sexe?>">
                     </div>
                  </div>
                  
                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Age :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="age" value="<?php echo $age?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" href="indexInfo.php?id=<?php echo $_GET['id']?>" class="btn" style="background-color:#3b999c; 
                            color:#ffff">Modifier</button>
                     </div>

                     <div class="col-sm-3 d-grid">
                        <a class="btn " style=" background-color:#ffff; color:#3f9497" href="indexInfo.php?id=<?php echo $_GET['id']?>" role="button">Annuler</a>

                     </div>
                  </div>

               </form>
               </fieldset>
            </div>
  </div>
   <script src="js/main.js"></script>
</body>
</html>