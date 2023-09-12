<!--code PHP-->
<?php
//connection a la base de donnees

 include "connection.php";

// Database connection details

if ($_SERVER['REQUEST_METHOD']=='POST'){
   $num=$_POST["num"];
   $Specialite=$_GET['sp'];
   $loc=$_POST["loc"];
   $equip=$_POST["equip"];

   do{
      if (empty($num)||empty($Specialite)||empty($loc)||empty($equip)){
         $errorMessage = "all the fields are required";
         break;
      }

      //add new medecin

      $query = "INSERT INTO SalleOperation (NumSalle,SpecialiteSalle, Loc, Equipement) VALUES (:num, :Specialite, :loc, :equip)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([
         ':num' => $num,
         ':Specialite' => $Specialite,
         ':loc' => $loc,
         ':equip' => $equip
      ]);

      $succesMessage="salle ajouter avec correctly";
  
      header("location: listeSalle.php?sp=".$_GET['sp']);
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
    <title>Ajouter salle</title>
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
               <h1>Nouvelle salle de <?php echo $_GET['sp']?></h1>
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
                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">NUMERO DE LA SALLE :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="num" value="">
                     </div>
                  </div>
<!--
                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Specialite</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="Specialite" value="<?php echo $Specialite?>">
                     </div>
                  </div>
            -->
                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">LOCATION :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="loc" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">EQUIPEMENT :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="equip" value="">
                     </div>
                  </div>


                  <div class="row mb-3">
                     <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn " style="background-color:#3b999c;
                            color:#ffff" href="listeSalle.php?sp=<?php echo $_GET['sp']?>">Ajouter</button>
                     </div>

                     <div class="col-sm-3 d-grid">
                        <a class="btn" style=" background-color:#ffff; color:#3f9497" href="listeSalle.php?sp=<?php echo $_GET['sp']?>"  role="button">Annuler</a>

                     </div>
                  </div>

               </form>
            </div>
       
            </fieldset>
  </div>
   <script src="js/main.js"></script>
</body>
</html>