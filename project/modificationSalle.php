<?php
// Creation of the connection
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: show the data of the salle

    if (!isset($_GET["num"])) {
        header("location: listeSalle.php?sp=" . $_GET['sp']);
        exit;
    }

    $num = $_GET["num"];

    // Read the row of the selected salle from the database table
    $sql = "SELECT * FROM SalleOperation WHERE NumSalle = :num";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':num', $num);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header("location: listeSalle.php?sp=" . $_GET['sp']);
        exit;
    }

    $num = $row["NumSalle"];
    $Specialite = $row["SpecialiteSalle"];
    $loc = $row["Loc"];
    $equip = $row["Equipement"];
} else {
    // POST method: Update the data of the salle

    $num = $_POST["num"];
    $Specialite = $_POST["Specialite"];
    $loc = $_POST["loc"];
    $equip = $_POST["equip"];

    do {
        if (empty($num) || empty($Specialite) || empty($loc) || empty($equip)) {
            $errorMessage = "all the fields are required";
            break;
        }

        $sql = "UPDATE SalleOperation SET NumSalle = :num, SpecialiteSalle = :Specialite, Loc = :loc, Equipement = :equip WHERE NumSalle = :num";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':Specialite', $Specialite);
        $stmt->bindParam(':loc', $loc);
        $stmt->bindParam(':equip', $equip);
        $stmt->execute();

        // Check if the query executed correctly
        if (!$stmt) {
            $errorMessage = "invalid query" . $con->error;
            break;
        }
        
        $succesMessage = "salle updated correctly";

        header("location: listeSalle.php?sp=" . $_GET['sp']);
        exit;

    } while (false);
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Salle</title>
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
               <h1> Modifier salle de <?php echo $_GET['sp']?></h1>
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
                  <label class="col-sm-3 col-form-label">Numéro de salle :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="num" value="<?php echo $num ?>">
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
                     <label class="col-sm-3 col-form-label">Location :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="loc" value="<?php echo $loc?>">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Equipement :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="equip" value="<?php echo $equip?>">
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
                        <button type="submit" class="btn" style=" background-color:#3f9497; color:#ffff">Modifier</button>
                     </div>

                     <div class="col-sm-3 d-grid">
                     <a class="btn" style=" background-color:#ffff; color:#3f9497" href="listeSalle.php?sp=<?php echo $_GET['sp']?>" role="button">Annuler</a>
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