<?php

// Création de la connexion
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Méthode GET : afficher les données du patient

    if (!isset($_GET["id"])) {
        header("location: indexPatient.php");
        exit;
    }

    $id = $_GET["id"];

    // Lecture de la ligne du patient sélectionné depuis la table de la base de données
    $query = "SELECT * FROM Patient WHERE IdPatient=:id";
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
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Information Personelle</title>
    <link rel="stylesheet" href="css/index.css">
     <!--fontawesome script -->
     <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <ul class="nav nav-tabs">
    <li class="nav-item">
            <a class="nav-link" style=" background-color:#c1dce6; color:#3f9497" href="indexPatient.php" >Patients</a>
       </li>
        <li class="nav-item">
          <a class="nav-link active" style=" background-color:#3f9497; color:#ffff"aria-current="page"  href="indexInfo.php">Information personnelle</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"style=" background-color:#ffff; color:#3f9497" href="indexMaladie.php?id=<?php echo $_GET['id'];?>">Maladies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"   style=" background-color:#ffff; color:#3f9497" href="indexAnalyse.php?id=<?php echo $_GET['id'];?>">Analyses</a>
        </li>
       
      </ul>

     
      <div class="page">
      <!--user profile-->
      
           <!--formulaire-->
            <div class="container my-5">
            <fieldset class="row border">
               <div class="titre">
               <h1>Information personnelle</h1>
               </div>
              


               <form method="post">
                  <input type="hidden" name="id" value="<?php echo $id ?>">

                  <div class="row mb-3">
                    
                    <div class="col-sm-6">
                       <div class="image">
                           <img src="Patient/<?php echo $row['Image']; ?> "alt="Image" 
                           style="height: 150px;
                           margin-left:500px;width: 150px;border-radius: 50%;object-fit: cover;margin-bottom: 5px">
                       </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Nom :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" disabled name="nom" value="<?php echo $nom ?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Prénom :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" disabled name="prenom" value="<?php echo $prenom?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Numero de téléphone :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" disabled name="tele" value="<?php echo $tele?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Adresse :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" disabled name="adresse" value="<?php echo $adresse?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Email :</label>
                     <div class="col-sm-6">
                        <input type="email" class="form-control" disabled name="email" value="<?php echo $email?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Groupe sangauin :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" disabled name="gs" value="<?php echo $gs?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Sexe :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" disabled name="sexe" value="<?php echo $sexe?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Age :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" disabled name="age" value="<?php echo $age?>">
                     </div>
                  </div>

                 

                  <div class="row mb-3">
                     <div class="offset-sm-3 col-sm-3 d-grid">
                        <a  class="btn " style=" background-color:#3f9497; color:#ffff"
                        href="modificationPatient.php?id=<?php echo $row['IdPatient']; ?>">Modifier</a>
                     </div>
            

                     <div class="col-sm-3 d-grid">
                        <a class="btn " style=" background-color:#ffff; color:#3f9497" href="indexPatient.php" role="button">Annuler</a>

                     </div>
                  </div>

               </form>
            </div>
            
  

               </fieldset>
  </div>

              
</div>
<script src="js/main.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>