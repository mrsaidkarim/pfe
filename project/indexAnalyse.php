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
    <title>liste Analyse</title>
</head>
<body>
<div class="fullPage">

<!--Sidebar-->
<ul class="nav nav-tabs">
<li class="nav-item">
            <a class="nav-link" style=" background-color:#c1dce6; color:#3f9497" href="indexPatient.php" >Patients</a>
       </li>
            <a class="nav-link " style=" background-color:#ffff; color:#3f9497" href="indexInfo.php?id=<?php echo $_GET['id'];?>" >Information Personnelle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " style=" background-color:#ffff; color:#3f9497"  href="indexMaladie.php?id=<?php echo $_GET['id'];?>"  >Maladies</a>
        </li>
       <li class="nav-item">
            <a class="nav-link active" style=" background-color:#3f9497; color:#ffff" aria-current="page" href="indexAnalyse.php?id=<?php echo $_GET['id'];?>" >Analyses</a>
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
        <div class="button">
            <a class="btn " style=" background-color:#3f9497; color:#ffff" href="CreateAnalyse.php?id=<?php echo $_GET['id'];?>"
                role="button">Ajouter analyse</a>
        </div>
        <br>
        <div class="row d-flex justify-content-center pt-5 ">
            <table class="table col-sm-4 col-lg-8">
                <thead>
                    <tr id="header">
                        <th>Nom </th>
                        <th>Nom du maladie</th>
                        <th>Nom du médecin</th>
                        <th>Date </th>
                        <th>Resultat</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   require_once 'connection.php';
                   $sql = "SELECT a.NomAnalyse, a.DateAnalyse, a.Resultat, m.NomMaladie, me.NomMedecin  
                        FROM Analyse a
                        JOIN MaladieAnalyse ma ON a.IdAnalyse = ma.IdAnalyse
                        JOIN Maladie m ON ma.IdMaladie = m.IdMaladie
                        JOIN Medecin me ON m.IdMedecin = me.IdMedecin";

                   $stmt = $pdo->query($sql);
           
                   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                       echo "
                           <tr class='tr'>
                               <td>{$row['NomAnalyse']}</td>
                               <td>{$row['NomMaladie']}</td> 
                               <td>{$row['NomMedecin']}</td> 
                               <td>{$row['DateAnalyse']}</td>
                               <td>{$row['Resultat']}</td>
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