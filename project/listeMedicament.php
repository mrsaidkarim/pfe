<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--fontawesome script -->
    <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
     <!--Boststrap-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css">
    <title>liste Medicament</title>
</head>
<body>
<div class="fullPage">

<!--Sidebar-->
<ul class="nav nav-tabs">
<li class="nav-item">
            <a class="nav-link" style=" background-color:#c1dce6; color:#3f9497" href="indexPatient.php" >Patients</a>
       </li>
        <li class="nav-item">
            <a class="nav-link" style=" background-color:#ffff; color:#3f9497"  href="indexInfo.php?id=<?php echo $_GET['id'];?>" >Information Personelle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" style=" background-color:#3f9497; color:#ffff" aria-current="page" href="indexMaladie.php?id=<?php echo $_GET['id'];?>"  >Maladies</a>
        </li>
       <li class="nav-item">
            <a class="nav-link" style=" background-color:#ffff; color:#3f9497" href="indexAnalyse.php?id=<?php echo $_GET['id'];?>" >Analyses</a>
       </li>
       
</ul>

<!--user profile-->
<div class="content">

    <!--liste des medecins-->
    <div class="cnt-liste">
        <br>

        <div class="searchbar" style="width: 30%">
            <input placeholder="Chercher..." id="searchBar" name="searchBar" type="text">
            <button><i class="fa-solid fa-magnifying-glass glass"></i></button>

        </div>
        <br>
        <div class="above">
        
        <div class="mala">
            <h6>Maladie:<?php session_start(); echo $_SESSION['NomMal']."  "; echo $_SESSION['date']?> <br>Médecin:<?php echo $_SESSION['NomMéd']?> </h6>
        </div>
        <div class="button">
            <a class="btn " style=" background-color:#3f9497; margin-left: 0;color:#ffff" href="createMedicament.php?id=<?php echo $_GET['id']?>&idm=<?php echo $_GET['idm']?>"
                role="button">Ajouter un médicament</a>
        </div>
        </div>
        
        <br>
        <div class="row d-flex justify-content-center pt-5 ">
            <table class="table col-sm-4 col-lg-8">
                <thead>
                    <tr id="header">
                        <th>Nom </th>
                        <th>Date </th>
                        <th>Traitement</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   require_once 'connection.php';

                   $sql = "SELECT IdMedicament FROM MaladieMedicament where IdMaladie = :idm";
                   $stmt = $pdo->prepare($sql);
                   $stmt->execute([
                       'idm' => $_GET['idm']
                   ]);

                   $idMedicaments = $stmt->fetchAll(PDO::FETCH_COLUMN);

                   $sql = "SELECT * FROM Medicament where IdMedicament IN (".implode(",", $idMedicaments).")";
                   $stmt2 = $pdo->query($sql);

                   while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                       echo "
                           <tr class='tr'>
                               <td>{$row['NomMedicament']}</td>
                               <td>{$row['DateMedicament']}</td> 
                               <td>{$row['Traitement']}</td>
                           </tr>
                       ";
                   }
                   ?>
                </tbody>
            </table>

        </div>
    </div>


</div>
</div>

<script >
    const searchInput = document.querySelector("#searchBar");
const tableRows = document.querySelectorAll(".tr ");

searchInput.addEventListener("input", filterTable);

function filterTable(e) {
  const searchText = e.target.value.toLowerCase();

  tableRows.forEach((row) => {
    const rowData = row.textContent.toLowerCase();
    if (rowData.includes(searchText)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
</body>
</html>