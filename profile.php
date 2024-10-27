<?php 

session_start();

if (isset($_SESSION['id_startuper'])) {

include "database.php";
$id_startuper = $_SESSION["id_startuper"];
    $sql = "SELECT * FROM startuper WHERE id_startuper = ?";
	$sql = $conn->prepare($sql);
    $sql->bindParam(1, $id_startuper);
	$sql->execute();
    
    if($sql->rowCount() == 1){
        $user = $sql->fetch(PDO::FETCH_ASSOC);
    }else {
        return 0;
    }


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
    
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .w-450 {
    width: 450px;
  }
  .vh-100 {
    min-height: 100vh;
  }
  .w-350 {
    width: 350px;
  }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background: rgb(131, 169, 192);">
        <a class="navbar-brand" href="start2.html">
            <img src="logo.png" width="50" height="50" class="d-inline-block align-top" alt="SE-logo">
            <strong style="font-size: 40px; font-weight: 600; font-family: 'Condiment'; color: rgba(0, 0, 0, 0.75)">Start-Ups Capital</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-links"
            aria-controls="nav-links" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-links">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="form_projet.html">Ajouter Projet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lister_projet.php">Mes Projets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
        </div>
        <a href="profile.php" style="margin-right: 40px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" viewBox="0 0 16 16">
              <circle cx="8" cy="8" r="8" fill="grey"/>
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
          </a>
    </nav>
</header>

    <?php if ($user) { ?>
    <div class="d-flex justify-content-center align-items-center vh-100" style="background-image: url(white.jpg);">
    	
    <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="shadow w-350 p-3 text-center">
        <?php
        // Récupérer les données de l'image depuis la base de données
        $imageData = $user['photo']; // Supposons que 'photo' contient les données de l'image en base64
        $imageType = 'image/jpeg';  // Modifier le type d'image selon vos besoins, par exemple 'image/png' pour PNG
        
        // Afficher l'image à l'aide de la balise img avec les données base64 encodées
        echo '<img src="data:' . $imageType . ';base64,' . base64_encode($imageData) . '" class="img-fluid rounded-circle" />';
        ?>
        <h3 class="display-4"><?=$user['nom']?></h3>
        <a href="edit_profil.php" class="btn btn-primary">Edit Profile</a>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
</div>

    </div>
    <?php }else { 
    header("Location: login.html");
    exit;
    } ?>
</body>
</html>

<?php }else {
	header("Location: login.html");
	exit;
} ?>