<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Capital Risque</title>
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  
  <link rel="stylesheet" href="style.css">
  
  <link rel="shortcut icon" type="image/png" href="logo.png" />
  <style>
      /* Style pour le cadre du range */
      .range-container {
          width: 80%; /* Largeur du cadre */
          margin: 20px auto; /* Marge autour du cadre */
          padding: 10px; /* Espacement intérieur du cadre */
          border: 1px solid #ccc; /* Bordure du cadre */
          border-radius: 5px; /* Coins arrondis */
          text-align: center; /* Alignement du texte au centre */
        }
        
        /* Style pour le texte du range */
        .range-value {
            display: inline-block; /* Afficher en ligne avec le range */
            font-size: 18px; /* Taille de police du texte */
            margin-left: 10px; /* Marge à gauche du texte */
        }
        .btn-acheter {
      margin-left: 20px; /* Marge au-dessus du bouton */
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
            <a class="nav-link" href="lister_tout_projet.php">Projets</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
        </ul>
        <button id="nav-contact" class="btn btn-outline-dark my-2 my-sm-0" type="submit">Mon Profil</button>
      </div>
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
  <!-- Ajout du code PHP pour afficher les détails du projet -->
  <?php
  session_start();
  include 'database.php';

  if (isset($_GET['id'])) {

      $id_projet = $_GET['id'];

      $projet = array();
      $stmt = $conn->prepare("SELECT * FROM projet WHERE id_projet = ?");
      $stmt->bindParam(1, $id_projet);
      $stmt->execute();
      $projet = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($projet) {
          $titre = $projet['titre'];
          $description = $projet['description'];
          $nb_actions = $projet['nombre_actions_a_vendre'];
          $prix_action = $projet['prix_action'];

          // Afficher les détails du projet sous forme de paragraphes avec des classes Bootstrap
          echo "<div class='container'>";
          echo "<h2>Détails du Projet</h2>";
          echo "<p class='font-weight-bold'>Titre :</p><p>$titre</p>";
          echo "<p class='font-weight-bold'>Description :</p><p>$description</p>";
          echo "<p class='font-weight-bold'>Nombre d'actions à vendre :</p><p>$nb_actions</p>";
          echo "<p class='font-weight-bold'>Prix unitaire de l'action :</p><p>$prix_action</p>";
          echo "</div>";

        echo"<form action='traitement_achat.php' method='post'>";
        echo "<div class='range-container'>"; 
      echo "<label for='customRange1' class='form-label'>Nombre d'actions à acheter :</label>"; 
      echo "<input type='range' class='form-range' id='customRange1' min='1' max='$nb_actions' value='1' name='nb_actions'>"; 
      echo "<span class='range-value' id='rangeValue'>1</span>"; 
      echo "<input type='hidden' name='id_projet' value='$id_projet'>";
      echo "<button type='submit' class='btn btn-success btn-acheter' name='acheter'>Acheter</button>"; 
    echo "</div>"; 
    echo"</form>";


      } else {
          echo "<div class='container'>";
          echo "<p>Projet non trouvé.</p>";
          echo "</div>";
      }

      // Fermer la requête et la connexion à la base de données
      $stmt->closeCursor(); // Libérer les ressources de la requête
      $conn = null; // Fermer la connexion
  } else {
      echo "<div class='container'>";
      echo "<p>ID de projet non spécifié.</p>";
      echo "</div>";
  }
  ?>
  <script>
    // JavaScript pour mettre à jour la valeur du range sélectionnée
    var rangeInput = document.getElementById('customRange1');
    var rangeValue = document.getElementById('rangeValue');

    rangeInput.addEventListener('input', function() {
      rangeValue.textContent = this.value;
    });
  </script>
</body>

</html>
