<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Maladies</title>
    <!--fontawesome script -->
    <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
    <!--Boststrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <ul class="nav nav-tabs">
    <li class="nav-item">
            <a class="nav-link" style=" background-color:#c1dce6; color:#3f9497" href="indexPatient.php" >Patients</a>
       </li>
        <li class="nav-item">
            <a class="nav-link " href="indexInfo.php?id=<?php echo $_GET['id'];?>" style=" background-color:#ffff; color:#3f9497" >Information personnelle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" style=" background-color:#3f9497; color:#ffff" href="indexMaladie.php?id=<?php echo $_GET['id'];?>"  >Maladies</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="indexAnalyse.php?id=<?php echo $_GET['id'];?>" style=" background-color:#ffff; color:#3f9497" >Analyses</a>
        </li>
      
    </ul>



    <div class="fullPage" >
        <div class="content" >
            <div class="cnt-liste">
                <br>

                <div class="searchbar" style="width: 30%">
                    <input placeholder="Chercher..." id="searchBar" name="searchBar" type="text">
                    <button><i class="fa-solid fa-magnifying-glass glass"></i></button>

                </div>
                <br>
                <div class="button">
                    <a class="btn " style=" background-color:#3f9497; color:#ffff" href="createMaladie.php?id=<?php echo $_GET['id'];?>"
                        role="button">Ajouter une maladie</a>
                </div>
                   
                



                <br>
                <div class="row d-flex justify-content-center pt-5 ">
                    <table class="table col-sm-4 col-lg-8">
                        <thead>
                            <tr id="header">
                                <th>Nom</th>
                                <th>Médecin</th>
                                <th>Date</th>
                                <th>Ordonnance</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            session_start();
                            require 'connection.php';
                            
                            $sql = "SELECT m.NomMaladie, m.DateMaladie, me.NomMedecin FROM Maladie m JOIN Medecin me ON m.IdMedecin = me.IdMedecin WHERE m.IdPatient = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                'id' => $_GET['id']
                            ]);

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $nomMaladie = $pdo->quote($row['NomMaladie']);
                                $sql1 = "SELECT IdMaladie FROM Maladie WHERE NomMaladie = $nomMaladie";
                                $stmt1 = $pdo->query($sql1);
                                $r = $stmt1->fetch(PDO::FETCH_ASSOC);
                                
                                        
                                $_SESSION['NomMal'] = $row['NomMaladie'];
                                $_SESSION['NomMéd'] = $row['NomMedecin'];
                                $_SESSION['date'] = $row['DateMaladie'];
                                echo "
                                    <tr class='tr'>
                                        <td>{$row['NomMaladie']}</td>
                                        <td>{$row['NomMedecin']}</td>
                                        <td>{$row['DateMaladie']}</td>
                                        <td>   
                                        <a class='btn btn-sm' style='color:#3f9497' href='listeMedicament.php?id={$_GET['id']}&idm={$r['IdMaladie']}'>
                                            <i class='fa-solid fa-capsules fa-2x'></i>
                                        </a>
                                    </td>
                                            
                                        </td>
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
    <script>
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