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
            <a class="nav-link " href="indexInfo.php" >Information Personelle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="indexMaladie.php"  >Maladies</a>
        </li>
       <!-- <li class="nav-item">
            <a class="nav-link" href="indexAnalyse.php" >Analyses</a>
        </li>-->
    </ul>

<!--user profile-->
<div class="content">

    <!--liste des medecins-->
    <div class="cnt-liste">
        <br>


        <div class="searchbar" style="width: 30%">
            <input placeholder="chercher..." id="searchBar" name="searchBar" type="text">
            <button><i class="fa-solid fa-magnifying-glass glass"></i></button>

        </div>
        <br>
        <div class="button">
            <a class="btn " style=" background-color:#3f9497; color:#ffff" href="createAnalyse.php"
                role="button">Ajouter Analyse</a>
        </div>
        <br>
        <div class="row d-flex justify-content-center pt-5 ">
            <table class="table col-sm-4 col-lg-8">
                <thead>
                    <tr id="header">
                        <th>nom d'Analyse</th>
                        <th>Date </th>
                        <th>Resultat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class='tr'>
                        <td>XXXXX</td>
                        <td>23/05/23</td>
                        <td>YYYYY</td>
                        
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
</div>





<script src="index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
</body>
</html>