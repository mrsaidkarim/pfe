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
<?php
    require_once 'connection.php';
    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les valeurs du formulaire
        $nomMedicament = $_POST['nomMedicament'];
        $date = $_POST['dateMedicament'];
        $traitement = $_POST['traitement'];
        $idm = $_GET['idm'];
do{
        if (empty($nomMedicament)||empty($date)||empty($traitement)){
         $errorMessage = "all the fields are required";
         break;
      }
      
        // Préparer la requête d'insertion
        $sql = "INSERT INTO Medicament (NomMedicament, DateMedicament, Traitement) VALUES (:NomMedicament, :DateMedicament, :Traitement)";
        $stmt = $pdo->prepare($sql);
        // Exécuter la requête d'insertion avec les valeurs du formulaire
        $stmt->execute([
            'NomMedicament' => $nomMedicament,
            'DateMedicament' => $date,
            'Traitement' => $traitement
        ]);

        // Récupérer l'ID du médicament inséré
        $idMedicament = $pdo->lastInsertId();

        // Insérer l'association dans la table de liaison
        $sql1 = "INSERT INTO MaladieMedicament (IdMaladie, IdMedicament) VALUES (:IdMaladie, :IdMedicament)";
        $stmt1 = $pdo->prepare($sql1);
        // Exécuter la requête d'insertion avec les valeurs du formulaire
        $stmt1->execute([
            'IdMaladie' => $idm,
            'IdMedicament' => $idMedicament
        ]);

        // Rediriger vers la page de liste des médicaments
        header("Location: listeMedicament.php?id=".$_GET['id']."&idm=".$idm);
        exit();
      }while(false);
    }
    ?>

   <div class="page" >
      <!--user profile-->
      <div class="content" >
           <!--formulaire-->
        <div class="container my-5">
        <fieldset class="row border">
         <div class="titre">
            <h1>Ajouter un médicament</h1>
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
                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Nom :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="nomMedicament" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Date  :</label>
                     <div class="col-sm-6">
                        <input type="date" class="form-control" name="dateMedicament" value="">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label class="col-sm-3 col-form-label">Traitement :</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="traitement" value="">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn  " style="background-color:#3b999c;
                            color:#ffff" >Ajouter</button>
                     </div>
                     
                     <div class="col-sm-3 d-grid">
                        <a class="btn " style=" background-color:#ffff; color:#3f9497"   href="listeMedicament.php?id=<?php echo $_GET['id']?>&idm=<?php echo $_GET['idm']?>" role="button">Annuler</a>

                     </div>
                  </div>
                  
                  </div>
               </form>
            </div>
   </div>        
   </fieldset>
  </div>
   <script src="js/main.js"></script>
</body>
</html>