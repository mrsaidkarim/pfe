
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tableau de bord</title>
    <!-- fontawesome script -->
    <script
      src="https://kit.fontawesome.com/22c8697aab.js"
      crossorigin="anonymous"
    ></script>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&family=Poppins:wght@400;500;600;700;800&family=Dongle:wght@700&family=Inter:wght@300;400;500;600;700&family=Open+Sans:wght@400;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <!-- main css file -->
    <link rel="stylesheet" href="css/index.css" />
  </head>
  <body>
<?php
require_once "connection.php";
session_start(); 
$email=$_SESSION['email'];
// Prepare and execute a SELECT query
$stmt = $pdo->prepare("SELECT * FROM Utilisateur where email=?");


$stmt->execute(array($email));
// Fetch all rows as an associative array
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($row[0]['Roles'] =='User'){
  $stmt1 = $pdo->prepare("SELECT NomMedecin as nom, PrenomMedecin as prenom, TeleMedecin as tele, Specialite, Email  FROM Medecin where email=?");
  $stmt1->execute(array($email));
  $est_medecin = true;
  
}
else {
  $stmt1 = $pdo->prepare("SELECT NomAdmin as nom, PrenomAdmin as prenom, TeleAdmin as tele, Email FROM Admin where email=?");
  $stmt1->execute(array($email));
  $est_medecin = false;
}

$user = $stmt1->fetch(PDO::FETCH_ASSOC);
// Loop through the users and display their data
//foreach ($medecin as $user) {}

?>
    <div class="page">
      <?php
        if(!$est_medecin) echo'
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
            <a href="indexSalle.php">
              <i class="fas fa-procedures"></i>
              <span>Les salles</span>
            </a>
          </li>
        </ul>
        </div>';
        else
          echo '
          <div class="sidebar">
          <ul>
            <li>
              <a href="#">
                <i class="fa-sharp fa-solid fa-registered"></i>
                <span>eserve</span>
              </a>
            </li>
            <li>
              <a href="planning/planning.php">
                <i class="fa-regular fa-chart-bar fa-fw"></i>
                <span>Planning</span>
              </a>
              </li>
          </ul>
          </div>'
      ?>
      <div class="content">
        <div class="head">
          <div class="menu">
            <i class="fas fa-bars"></i>
          </div>
          <div class="user">
            <div class="user-info "> 
              <img src="images/usricon.png" id="usericon" alt="image">
              <?php
                if(!$est_medecin)echo '<h3 style="color:#ffff;">admin</h3>';
                else echo'<h3 style="color:#ffff;">médecin</h3>';
              ?>
            </div>
          </div>
          <div class="submenu-wrap">
            <div class="submenu">
              <div class="user-info">
              </div>
            
              <a href="profil.php" class="submenu-link">
                <p>profil</p>
             
              </a>
              <hr />
              <a href="deconnexion.php" class="submenu-link">
                <p>Se déconnecter</p>
             
              </a>
            </div>
          </div>
        </div>
        <div class="infos">
          <nav >
            <section class="infos-sidebar infos-left-sidebar">
              <section>
                <img src="images/usricon.png" alt="user" />

                <p id="name"> <?php echo $user['nom'] . " " . $user['prenom'] ?> </p>
                <p id="specialite"><?php $temp = $est_medecin ? $user['Specialite'] : "Admin";echo $temp;?></p>
              </section>
              <ul>
                <li class="selected">
                  <a>
                    <span>Détails du compte</span>
                  </a>
                </li>
                <li>
                  <a>
                    <span>Mot de passe</span>
                  </a>
                </li>
              </ul>
            </section>
              <section class="infos-sidebar infos-right-sidebar">
              <form id="edit-info">
                <label>Nom : <input type="text" disabled name="nom" value="<?php echo $user['nom']?>"/></label>
                <label>Prenom : <input type="text"  disabled name="prenom" value="<?php echo $user['prenom']?>"/></label>
                <label>Email : <input type="text" name="email" value="<?php echo $user['Email']?>"/></label>
                <label>Tel : <input type="number" name="tel" value="<?php echo $user['tele']?>" /></label>
                <button type="button">enregistrer</button>
              </form>
              <form id="repeat-password" class="hidden-form">
                <label>ancien mot de passe : <input type="password" /></label>
                <label>nouveau mot de passe : <input type="password" /></label>
                <label>répeter le mot de passe : <input type="password" /></label>
                <button type="button">enregistrer</button>
              </form>
            </section>
          </nav>
        </div>
      </div>
    </div>
    <script src="js/main.js"></script>
  </body>
</html>

