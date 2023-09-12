<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Des Salles</title>
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
     <!--$_GET['sp']; -->
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
                  <a  href="indexMedecin.php">
                     <i class="fas fa-user-md"></i>
                      <span>Les médecins</span>
                  </a>
             </li>
              <li>
                  <a href="indexPatient.php">
                       <i class="fas fa-user-injured"></i>
                      <span>Les patients</span>
                  </a>
              </li>
              
              <li>
                  <a  class = "active" href="indexSalle.php">
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
                <div class="user-info">
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
                <a href="#" class="submenu-link">
                <p>Se déconnecter</p>
                </a>
             </div>
          </div>
        </div>

        <!--searchbar-->
<div class="titre">
       <h1> <?php echo $_GET['sp']?></h1>
       </div>
        <!--liste des salles-->
        <div class="cnt-liste">
<br>
            <div class="searchbar" >
                <input placeholder="chercher..." id="searchBar" name="searchBar"
                type="text">
               <button> <i class="fa-solid fa-magnifying-glass glass"></i></button>
            </div>
            <br>
            <div class="button">
            <a class="btn  " style=" background-color:#3f9497; color:#ffff" href="createSalle.php?sp=<?php echo $_GET['sp']?>" role="button">Ajouter une salle</a>
            </div>
            <br>
            
            <table class="table">
                <thead>
                    <tr id="header">
                        
                        <th>Numéro de la salle</th>
                        <!--<th>SpecialiteSalle</th>-->
                        <th>Location</th>
                        <th>Equipement</th>
                        <!--<th>Capacite</th>-->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> 
                <?php
    include "connection.php";

   
       
        $sql = "SELECT * FROM SalleOperation WHERE SpecialiteSalle = '" . $_GET['sp'] . "'";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "
                <tr class='tr'>
                  
                    <td>{$row['NumSalle']}</td>
                   
                    <td>{$row['Loc']}</td>
                    <td>{$row['Equipement']}</td>
                    
                    <td>
                        <a class='btn  btn-sm' style='color:#3b999c' href='modificationSalle.php?sp={$_GET['sp']}&num={$row['NumSalle']}'>
                        <i class='fa fa-edit '></i>
                        </a>
                        <i class='fa fa-trash  ' style='color:#3f9497' data-bs-toggle='modal' 
                        data-bs-target='#exampleModal".$row['NumSalle']."'>
                        </i>     
                    </td>
                </tr>
                <div class='modal fade' id='exampleModal".$row['NumSalle']."' role='dialog'>
                <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-body'>
                      <p>etes vous sur de vouloir supprimer cette salle?</p>
                  </div>
                  <div class='modal-footer'>
                      <button type='button' class='btn'style=' background-color:#c1dce6; color:#3f9497' data-bs-dismiss='modal'>annuler</button>
                      <a href='suppressionSalle.php?deleteid={$row['NumSalle']}&sp={$_GET['sp']}'>
                          <button class='btn' style='background-color:#3f9497; color:#ffff' type='button'> Confirmer</button>
                      </a>
                  </div>
                  </div>
                </div>
              </div>
            ";
        }
    
?>
                </tbody>
            </table>
         
        </div>
        


    </div>
    <script src="js/main.js"></script>
</body>
</html>