<!--code PHP-->
<?php

//connection a la base de donnees

include "connection.php";

// Database connection details

if ($_SERVER['REQUEST_METHOD']=='POST'){
   $nom=$_POST["nom"];
   $prenom=$_POST["prenom"];
   $tele=$_POST["tele"];
   $Specialite=$_POST["Specialite"];
   $email=$_POST["email"];
   $MotDePasse=$_POST["MotDePasse"];
do{
      if (empty($nom)||empty($prenom)||empty($tele)||empty($Specialite)||empty($email)||empty($MotDePasse)){
         $errorMessage = "Tous les champs sont obligatoires";
         break;
      }

      //add new medecin

      $query = "INSERT INTO Utilisateur (Email, MotDePasse,Roles) VALUES (:email, :MotDePasse,'user')";
      $stmt = $pdo->prepare($query);
      $stmt->execute([
         ':email' => $email,
         ':MotDePasse' => $MotDePasse
      ]);

      $query = "INSERT INTO Medecin (NomMedecin, PrenomMedecin, TeleMedecin, Specialite, Email ) VALUES (:nom, :prenom, :tele, :Specialite, :email)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([
         ':nom' => $nom,
         ':prenom' => $prenom,
         ':tele' => $tele,
         ':Specialite' => $Specialite,
         ':email' => $email
      ]);
      
      header("location: indexMedecin.php");
      exit;
   }while(false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Medecin</title>
      <!-- fontawesome script -->
      <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
    <!--BOOSTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 <!--css-->
<link rel="stylesheet" href="css/index.css">
</head>
<body>
   <div class="page" >
      <!--user profile-->
      <div class="content" >
         
           <!--formulaire-->
            <div class="container my-5">
            <fieldset class="row border">
            <div class="titre">
               <h1>Nouveau médecin</h1>
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
   
   
   <div class="formul">
      <br>
                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Nom :</label>                  
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="nom" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Prénom :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="prenom" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Téléphone :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="tele" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Spécialité :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="Specialite" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Email :</label>
                     <div class="col-sm-6">
                        <input type="email" class="form-control" name="email" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Mot de passe :</label>
                     <div class="col-sm-6">
                        <input type="password" class="form-control" name="MotDePasse" value="">
                     </div>
                  </div>
                 
                  <div class="row mb-3">
                     <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn  " style="background-color:#3b999c;
                            color:#ffff" >Ajouter</button>
                     </div>
                     
                     <div class="col-sm-3 d-grid">
                        <a class="btn " style=" background-color:#ffff; color:#3f9497"   href="indexMedecin.php" role="button">Annuler</a>

                     </div>
                  </div>
                  
                  </div>
                
               </form>
            </div>
            </fieldset>
  </div>
   <script src="js/main.js"></script>
</body>
</html>