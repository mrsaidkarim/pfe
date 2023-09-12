<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <!-- fontawesome script -->
    <script src="https://kit.fontawesome.com/22c8697aab.js" crossorigin="anonymous"></script>
    <!-- main css file -->
    <link rel="stylesheet" href="css/index.css">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&family=Dongle:wght@700&family=Inter:wght@300;400;500;600;700&family=Open+Sans:wght@400;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page">
        <div class="content bg">
            <a href="#" class="first">
                <i class="fa-sharp fa-solid fa-registered"></i>
                <span>eserve</span>
            </a>
            <div class="form-box">
                <div class="form-value">
                    <form action="login_traitement.php" method="post">            
                        <h2>Se connecter</h2>
                        <div class="inputbox">
                            <i class="fas fa-envelope"></i>
                            <?php 
                    if(isset($_GET['pwd'])){
                        echo $_GET['pwd'];
                    }
                    if(isset($_GET['login_err']))
                     {
                    $err = htmlspecialchars($_GET['login_err']);
                    if($err=='email' ){
                        echo "<div>email invalid</div>";
                    }
                    }    
                    ?>
                    <input type="email" placeholder="Email" required name="email">
                        </div>
                        <div class="inputbox">
                            <i class="fas fa-lock"></i>
                            <?php 
                    if(isset($_GET['login_err']))
                     {
                    $err = htmlspecialchars($_GET['login_err']);
                    if($err=='password' ){
                        echo "<div>password invalid</div>";
                    }
                    }    
                    ?>                        
                     <input type="password" placeholder="Mot de passe" required name="password">
                        </div>
                        <div class="forget">
                            <a href="#">Mot de passe oublié ?</a>
                        </div>
                        <button>connexion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body> 
</html>