<!--code PHP-->
<?php
//connection a la base de donnees

include "connection.php";

// Database connection details

if ($_SERVER['REQUEST_METHOD']=='POST'){
   $nom=$_POST["nom"];
   $prenom=$_POST["prenom"];
   $tele=$_POST["tele"];
   $adresse=$_POST["adresse"];
   $email=$_POST["email"];
   $gs=$_POST["gs"];
   $sexe=$_POST["sexe"];
   $age=$_POST["age"];
   $Image=$_FILES['Image']['name'];
   do{
      if (empty($nom)||empty($prenom)||empty($tele)||empty($adresse)||empty($email)||empty($gs)
      ||empty($sexe)||empty($age)||empty($Image)){
         $errorMessage ="Tous les champs sont obligatoires";
         break;
      }

      //add new medecin

     $query = "INSERT INTO Patient (NomPatient, PrenomPatient, TelePatient, AdressePatient,
      EmailPatient,GroupeSanguin,Sexe,AgePatient,Image)
       VALUES (:nom, :prenom, :tele, :adresse, :email,:gs,:sexe,:age,:Image)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([
         ':nom' => $nom,
         ':prenom' => $prenom,
         ':tele' => $tele,
         ':adresse' => $adresse,
         ':email' => $email,
         ':gs' => $gs,
         ':sexe' => $sexe,
         ':age' => $age,
         ':Image' => $Image
      ]);
     
if ($upload) {
  move_uploaded_file($_FILES['Image']['tmp_name'],'Patient/'.$Image);
} else {
  echo 'erreur';
}
   
      $succesMessage="patient ajouter avec correctly";

      header("location: indexPatient.php");
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
    <title>Ajouter Patient</title>
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
               <h1>Nouveau patient</h1>
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


               <form enctype="multipart/form-data"  method="post">

               <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Image :</label>
                     <div class="col-sm-6">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control"
                        id="Image" name="Image" value="">
                     </div>
                  </div>


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
                     <label class="col-sm-3 col-form-label">Numéro de téléphone  :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="tele" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Adresse :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="adresse" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Email :</label>
                     <div class="col-sm-6">
                        <input type="email" class="form-control" name="email" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Groupe sanguin :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="gs" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Sexe :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="sexe" value="">
                     </div>
            </div>
                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Age :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="age" value="">
                     </div>
                  </div>

                  

                  <div class="row mb-3">
                     <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn " name="ajouter" style="background-color:#3b999c;
                            color:#ffff">Ajouter</button>
                     </div>

                     <div class="col-sm-3 d-grid">
                        <a class="btn " style=" background-color:#ffff; color:#3f9497" href="indexPatient.php" role="button">Annuler</a>

                     </div>
                  </div>

               </form>
            </div>
               </fieldset>
  </div>
   <script src="js/main.js"></script>
</body>
</html>