<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <!-- fontawesome script -->
    <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
   <!--css-->
<link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="page">

    <!--sidebar-->
        <div class="sidebar">
            <ul>
                <li>
                    <a href="#">
                        <i class="fa-sharp fa-solid fa-registered"></i>
                        <span>eserve</span>
                    </a>
                </li>
                <li>
                    <a class = "active" href="dashboard.php">
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
                    <a href="indexPatient.php">
                        <i class="fas fa-user-injured"></i>
                        <span>Les patients</span>
                    </a>
                </li>
                <li>
                    <a href="indexSalle.php">
                        <i class="fas fa-procedures"></i>
                        <span>Les salles</span>
                    </a>
                </li>
            </ul>
        </div>

        <!--user-->
        <div class="content">
            <div class="head">
                <div class="menu">
                    <i class="fas fa-bars"></i>
                </div>
                
                <div class="user">
                <div class="user-info "> 
                 <img src="images/usricon.png" id="usericon" alt="image">
                 <h3 style="color:#ffff;">admin</h3>
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
         
            <div class="infos">
              <!--  <h1>page de tableau de bord</h1>-->

                <!--cards-->
               <div class="cards-dash">

                <div class="card-d"> 
                    <div class="card-content">
                     
                       
                       <div class="number">
                       <?php
                      require_once "connection.php";

                       $sql = "SELECT COUNT(IdMedecin) AS total_medecins FROM Medecin";
                       $stmt = $pdo->query($sql);
                       $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    $totalMedecins = $row['total_medecins'];

                    echo '<span>' . $totalMedecins . '</span>';
                                  
                                   ?>
                        </div>
                        <div class="card-name">MÉDECINS</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-user-md"></i>
                    </div>
                </div>

                <div class="card-d"> 
                    <div class="card-content">
                     
                       <div class="number"> 
                       <?php
 
                      $sql = "SELECT COUNT(IdPatient) AS total_patients FROM Patient";
                       $stmt = $pdo->query($sql);
                      $row = $stmt->fetch(PDO::FETCH_ASSOC);
                       $totalPatients = $row['total_patients'];
                       echo '<spam>' . $totalPatients . '</spam>';
                         ?>

                       </div>
                       <div class="card-name">PATIENTS</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-wheelchair"></i>
                    </div>
                </div>

                <div class="card-d"> 
                    <div class="card-content">
                        <div class="number">
                        <?php
                            $sql = "SELECT COUNT(NumSalle) AS total_salle FROM SalleOperation";
                             $stmt = $pdo->query($sql);
                           $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                  $totalSalles = $row['total_salle'];
                                 echo '<spam>' . $totalSalles . '</spam>';
                                 
                                   ?>
                                  
                        </div>
                        <div class="card-name">SALLES</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-bed"></i>
                    </div>
                </div>

                <div class="card-d"> 
                    <div class="card-content">
                        <div class="number">
                        <?php
                            $sql = "SELECT COUNT(IdReservation) AS total_reservation FROM Reservation";
                             $stmt = $pdo->query($sql);
                             $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $totalReservation = $row['total_reservation'];
                            echo '<spam>' . $totalReservation . '</spam>';
                                
                                   ?>
                                  
                        </div>
                        <div class="card-name">RÈSERVATIONS</div>
                    </div>
                    <div class="icon-box">
                    <i class="fas fa-calendar"></i>
                    </div>
                </div>

               </div>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>