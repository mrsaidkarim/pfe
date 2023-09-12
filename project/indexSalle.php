<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Salles</title>
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
                  <a href="indexPatient.php">
                       <i class="fas fa-user-injured"></i>
                      <span>Les patients</span>
                  </a>
              </li>
              
              <li>
                  <a class = "active"  href="indexSalle.php">
                      <i class="fas fa-procedures"></i>
                     <span>Les salles</span>
                   </a>
               </li>
         </ul>
      </div>

     <!--user profile-->
        <div class="content">
            <div class="head" >
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
                            <a href="deconnexion.php" class="submenu-link">
                                <p>Se déconnecter</p>
                               
                            </a>
                        </div>
                    </div>
            </div>
        
<!--cards-->
        <div class="infos">
            <div class="infos">
                <h1>Spécialités médicales & chirurgicales</h1>
                </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100" >
                        <img src="images/CARDIOLOGIE.jpeg" class="card-img-top" alt="image">
                        <div class="card-body">
                          <h6 class="card-title">CARDIOLOGIE</h6>
                          <p class="card-text">s'intéresse à l'appareil cardiovasculaire,
                             c'est-à-dire au cœur et aux vaisseaux (artères et veines),
                             à la prévention ainsi qu'au traitement des anomalies et des maladies qui l'affectent</p>
                        </div>
                        <div class="card-footer">
                            <a href="listeSalle.php?sp=Cardiologie" class="btn " style="background-color:#3b999c;
                            color:#ffff">voir les salles</a>
                          </div>
                    </div>
                </div>
    
                <div class="col">
                    <div class="card h-100">
                        <img src="images/ESTHETIQUE.jpeg" class="card-img-top" alt="image">
                        <div class="card-body">
                          <h6 class="card-title">ESTHETIQUE</h6>
                          <p class="card-text">INensemble de techniques de soins médicaux spécifiques, sans chirurgie,
                            destinés à améliorer les problèmes disgracieux,
                            liés ou pas aux effets du vieillissement, du corps ou du visage</p>
                        </div>
                        <div class="card-footer">
                            <a href="listeSalle.php?sp=Esthetique" class="btn"style="background-color:#3b999c;
                            color:#ffff">voir les salles</a>
                          </div>
                    </div>
                </div>
    
                <div class="col">
                    <div class="card h-100">
                        <img src="images/GYNECOLOGIE.jpeg" class="card-img-top" alt="image">
                        <div class="card-body">
                          <h6 class="card-title">GYNECOLOGIE</h6>
                          <p class="card-text">domaine médical qui étudie et traite les différentes pathologies
                             de l'appareil génital de la femme et les troubles hormonaux féminins</p>
                       </div>
                      <div class="card-footer">
                            <a href="listeSalle.php?sp=Gynecologie" class="btn" style="background-color:#3b999c;
                            color:#ffff">voir les salles</a>
                        </div>
                    </div>
                </div>
    
                <div class="col">
                    <div class="card h-100">
                          <img src="images/NEUROLOGIE.jpeg" class="card-img-top" alt="image">
                        <div class="card-body">
                            <h6 class="card-title">NEUROLOGIE</h6>
                            <p class="card-text">s'intéressant au fonctionnement et aux maladies des systèmes nerveux central
                                 (cerveau et moelle épinière), 
                                périphérique (nerfs crâniens et nerfs des membres) et végétatif.</p>
                        </div>
                        <div class="card-footer">
                            <a href="listeSalle.php?sp=Neurologie" class="btn" style="background-color:#3b999c;
                            color:#ffff">voir les salles</a>
                        </div>
                    </div>
                </div>
    
                <div class="col">
                    <div class="card h-100">
                          <img src="images/MAXILLO-FACIAL.jpeg" class="card-img-top" alt="image">
                        <div class="card-body">
                            <h6 class="card-title">MAXILLO-FACIAL</h6>
                            <p class="card-text">La néphrologie est la spécialité médicale visant à prévenir,
                                 diagnostiquer et soigner les maladies des reins.
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="listeSalle.php?sp=Maxillo-facial" class="btn " style="background-color:#3b999c;
                            color:#ffff">voir les salles</a>
                        </div>
                    </div>
                </div>
    
                      
                <div class="col">
                    <div class="card h-100">
                          <img src="images/NEPHROLOGIE.jpeg" class="card-img-top" alt="image">
                        <div class="card-body">
                            <h6 class="card-title">NEPHROLOGIE</h6>
                            <p class="card-text">Elle s'intéresse au diagnostic et au traitement des maladies,
                                 blessures et anomalies du visage, de la bouche, des dents et des mâchoires.</p>
                        </div>
                        <div class="card-footer">
                            <a href="listeSalle.php?sp=néphrologie" class="btn " style="background-color:#3b999c;
                            color:#ffff">voir les salles</a>
                        </div>
                    </div>
                </div>
    
                <div class="col">
                    <div class="card h-100">
                          <img src="images/OPHTALMOLOGIE.jpeg" class="card-img-top" alt="image">
                        <div class="card-body">
                            <h6 class="card-title">OPHTALMOLOGIE</h6>
                            <p class="card-text"> traitement des maladies de l œil et de ses annexes. 
                                est une spécialité 
                                médico-chirurgicale. Le médecin spécialisé pratiquant l'ophtalmologie </p>
                        </div>
                        <div class="card-footer">
                            <a href="listeSalle.php?sp=Ophtalmologie" class="btn" style="background-color:#3b999c;
                            color:#ffff">voir les salles</a>
                        </div>
                    </div>
                </div>
                    
                  
                    
            </div>
        </div>
    </div>
 </div>
   <script src="js/main.js"></script>
</body>
</html>