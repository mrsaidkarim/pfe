<?php

$nomMaladie="";
$dateMaladie="";
$nom = "";




$errorMessage="";
$succesMessage="";

//connection a la base de donnees

include "connection.php";

// Database connection details

if ($_SERVER['REQUEST_METHOD']=='POST'){
   $nomMaladie=$_POST["nomMaladie"];
   $dateMaladie=$_POST["dateMaladie"];
   $nom=$_POST["NomMedecin"];
   
   $idP = $_GET['id'];
   
   $qrp = "SELECT IdMedecin from Medecin where NomMedecin = :nom";
   $stmt = $pdo->prepare($qrp);
   $stmt->bindParam(':nom', $nom);
   $stmt->execute();
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $IdMedecin = $row['IdMedecin'];
      if (empty($nomMaladie)||empty($dateMaladie)){
         $errorMessage = "all the fields are required";
      }
      else{
      try{
          //add new maladie
      $query = "INSERT INTO Maladie (NomMaladie, DateMaladie, IdMedecin, IdPatient) VALUES (:nomMaladie,:dateMaladie, :id, :idP)";
      //$query = "INSERT INTO `Maladie`(`IdMaladie`, `NomMaladie`, `DateMaladie`, `IdMedecin`, `IdPatient`) VALUES (4,'sss',05/31/2023,1,1)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([
      ':nomMaladie' => $nomMaladie,
      ':dateMaladie' => $dateMaladie,
      ':id' => $IdMedecin,
      ':idP' => $idP
   ]);
      $nomMaladie="";
      $dateMaladie="";
      

      $succesMessage="maladie ajouter avec correctly";

      header("location: indexMaladie.php");
      }catch (PDOException $e) {
      // Handle any database errors
      echo "Error: " . $e->getMessage();
  }
}}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Maladie</title>
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
            <h1>Ajouter une maladie</h1>
         </div>

            
       <form method="post">
       <div class="formul">
                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">NOM DU MALADIE :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="nomMaladie" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">DATE DU MALADIE :</label>
                     <div class="col-sm-6">
                        <input type="date" class="form-control" name="dateMaladie" value="">
                     </div>
                  </div>

                 <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">NomMedecin :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="NomMedecin" value="">
                     </div>
                  </div>

                  <?php
                  if(!empty($succesMessage)){
                     echo"
                     <div class='row mb-3'>
                       <div class='offset-sm-3 col-sm-6'>
                     <div class='alert alert-success alert-dismissible fade show role='alert'>
                  <strong>$succesMessage</strong>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
                  </div>
                  </div>

                     ";
                  }
                  
                  
                  ?>
                  <div class="row mb-3">
                     <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn  " style="background-color:#3b999c;
                            color:#ffff" >ajouter</button>
                     </div>
                     
                     <div class="col-sm-3 d-grid">
                        <a class="btn "   href="indexMaladie.php" role="button">cancel</a>

                     </div>
                  </div>
                  
                  </div>
               </form>
            </div>
              
                  
            
  
   </div>        
               </fieldset>
  </div>
   <script src="index.js"></script>
</body>
</html>