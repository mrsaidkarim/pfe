
<?php
$servername="localhost";
$db_name="pfe";
$username="root";
$password="";
try{
    $pdo = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "echec de la connexion".$e->getMessage();
}
?>