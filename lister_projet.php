<?php
session_start();
include ('database.php');

// Vérifiez si l'utilisateur est connecté en tant qu'enseignant
if(isset($_SESSION['id_startuper']) ) {
    $id_startuper = $_SESSION['id_startuper'];

    // Récupérez les projets associés à l'enseignant en fonction de son ID
    $projet = array();
    $stmt = $conn->prepare("SELECT * FROM projet WHERE id_startuper IN (SELECT id_startuper FROM startuper WHERE id_startuper=:id_startuper)");
    $stmt->bindParam(':id_startuper', $id_startuper);
    $stmt->execute();

    // Boucler à travers les résultats avec PDO fetch
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $projet[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Startuper</title>
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  
  <link rel="stylesheet" href="style.css">
  
  <link rel="shortcut icon" type="image/png" href="logo.png" />
</head>

<body>
    <header>
    <nav style="background-color: white;" class="navbar navbar-expand-lg navbar-light sticky-top">
    <a id="navbar-brand" class="navbar-brand" href="start2.html">
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
    <div id="banner-jumbo-h" class="jumbotron">
      <div class="container">
        <h1 id="first-h" class="display-4 show" style="margin-bottom: 10px; font-family: 'Lato'; font-size: 40px;">
          Fastest market data.</h1>
        <h1 id="second-h" class="display-4 show" style="font-family: 'Lato'; font-size: 40px;">Latest financial news and
          report.</h1>
      </div>
    </div>
  </header>
  <div class="container">

    <div class="row">
      <div class="col-lg-12">
        <div>
          <table class="table table-bordered">
            <tr>
              <th>Titre</th>
              <th>Description</th>
              <th>Nombre action a vendre</th>
              <th>Nombre action vendues</th>
              <th>Prix Action</th>                                                
            </tr>
            <?php foreach($projet as $p) { ?>
              <tr>
                <td><?php echo $p['titre']; ?></td>
                <td><?php echo $p['description']; ?></td> 
                <td><?php echo $p['nombre_actions_a_vendre']; ?></td>
                <td><?php echo $p['nombre_action_vendues']; ?></td>
                <td><?php echo $p['prix_action']; ?></td>     
                <td><a class="btn btn-info" href="editer_projet.php?id=<?php echo $p['id_projet']; ?>">Éditer Projet</a></td>

              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
<?php
}
else {
    header("Location:welcome.html?error=Accès non autorisé");
}
?>