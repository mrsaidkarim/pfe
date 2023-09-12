<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Patients</title>
    <!--fontawesome script -->
     <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
     <!--BOOSTSTRAP-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <!--css-->
    <link rel="stylesheet" href="css/index.css">
    </head>
<body>
   <div class="page">
       <!--Sidebar-->
      <div class="sidebar">
         <ul>
             <li>
                 <a href="#">
                      <i class="fa-sharp fa-solid fa-registered"></i>
                       <span>eserve</span>
                  </a>
              </li>
              <li>
                  <a href="dashboard.php">
                      <i class="fa-regular fa-chart-bar fa-fw"></i>
                      <span>Tableau de bord</span>
                  </a>
              </li>
               <li>
                  <a href="indexMedecin.php">
                     <i class="fas fa-user-md"></i>
                      <span>Les médecins</span>
                  </a>
             </li>
              <li>
                  <a class = "active"  href="indexPatient.php">
                       <i class="fas fa-user-injured"></i>
                      <span>Les patients</span>
                  </a>
              </li>
              
              <li>
                  <a  href="indexSalle.php">
                      <i class="fas fa-procedures"></i>
                     <span>Les salles</span>
                   </a>
               </li>
         </ul>
     </div>

     <!--user profile-->
     <div class="content">
            <div class="head">
                <div class="menu">
                    <i class="fas fa-bars"></i>
                </div>
                
                <div class="user">
                <div class="user-info "> 
                 <img src="images/usricon.png" id="usericon" alt="image">
                 <h6 style="color:#ffff;">admin</h6>
                </div>
                </div>
                <div class="submenu-wrap">
                    <div class="submenu">
                    
                        <a href="profil.php" class="submenu-link">
                            <p>profil</p>
                           
                        </a>
                        <hr>
                        <a href="deconnexion.php" class="submenu-link">
                            <p>Se déconnecter</p>
                        </a>
                    </div>
                </div>
            </div>
     
        <!--liste des medecins-->
        <div class="cnt-liste">
            <br>
            <div class="titre">
            <h1>Liste des patients </h1>
             </div>
            <div class="searchbar" style="width: 30%">
                <input placeholder="chercher..." id="searchBar" name="searchBar"
                type="text">
                <button><i class="fa-solid fa-magnifying-glass glass"></i></button>
            </div>
            <br>
            <div class="button">
            <a class="btn " style=" background-color:#3f9497; color:#ffff" href="createPatient.php" role="button">Ajouter Patient</a>
            </div>
            <br>
            <table class="table">
                <thead>
                    <tr id="header">
                        <th>Id</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require "connection.php";

                    try {
                        // Set the error mode to exceptions
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT * FROM Patient";
                        $stmt = $pdo->query($sql);

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                                <tr class='tr'>
                                    <td>{$row['IdPatient']}</td>
                                    <td><img src='Patient/{$row['Image']}' alt='Image' width='40'></td>
                                    <td>{$row['NomPatient']}</td>
                                    <td>{$row['PrenomPatient']}</td>
                                    
                                    <td>{$row['EmailPatient']}</td>
                                    
                                    <td>
                                        <a class='btn  btn-sm' style='color:#3f9497' href='indexInfo.php?id={$row['IdPatient']}'>
                                        <i class='fa-solid fa-folder fa-2x'></i>
                                        </a>
                                    </td>
                                </tr>
                            ";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>