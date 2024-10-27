<?php
    session_start();
    
    include ("database.php");

    if(isset($_SESSION["id_startuper"])) {

        $id_startuper = $_SESSION["id_startuper"];
        $projet = array();
        $stmt = $conn->prepare("SELECT * FROM projet WHERE id_projet=?");
        $stmt->bindParam(1, $_REQUEST['id']);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($projet,$row);
        }
    }
    else {
        header("Location: login.html");
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editer un projet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" type="image/png" href="logo.png" />
  
  <style>
    body {
      background: url(banner.png);
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      border-radius: 10px;
      background-color: #fff;
      padding: 30px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }
    h1 {
      font-size: 28px;
      margin-bottom: 30px;
      text-align: center;
    }
    .form-control {
      border-radius: 5px;
    }
    label {
      font-weight: bold;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }
  </style>
</head>


<body>
    <header>
        <nav style="background-color: white;" class="navbar navbar-expand-lg navbar-light sticky-top">
          <a id="navbar-brand" class="navbar-brand" href="welcome.html">
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
        
        
      </header>4
    <div class="container">
    <h1>Editer un projet</h1>

    <form action="editer.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
      <?php foreach($projet as $p)  { ?>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du projet</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $p['titre']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description du projet</label>
            <input class="form-control" id="description" name="description" rows="3" value="<?php echo $p['description']; ?>" required></input>
        </div>
        
        <div class="mb-3">
            <label for="nb_action" class="form-label">Nombre d'actions à vendre</label>
            <input type="number" class="form-control" id="nb_action" name="nb_action" min="1" value="<?php echo $p['nombre_actions_a_vendre']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="prix" class="form-label">Prix unitaire de l'action</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" min="0.01" value="<?php echo $p['prix_action']; ?>" required>
        </div>
        <?php } ?>
        
        <div class="d-grid">
          <button type="submit" name="action" value="editer" class="btn btn-primary">Editer le projet</button><br>
          <button type="submit" name="action" value="supprimer" class="btn btn-danger">Supprimer le projet</button>

        </div>
    </form> 
    <?php if(isset($_GET['error']) && $_GET['error'] === 'action_vendue') { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        Impossible de supprimer le projet il y a des actions vendues.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/Jln1w2+9cI3zZ+C+Y4jT78129s7k9zE63z+yX8U4t17kQ2Z4K9i" crossorigin="anonymous"></script>
</body>
</html>

