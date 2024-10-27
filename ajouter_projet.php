<?php
    session_start();
    include ("database.php");

    if(isset($_SESSION["id_startuper"])) {

        $id_startuper = $_SESSION["id_startuper"];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titre = $_POST["titre"];
            $description = $_POST["description"];
            $nb_action = $_POST["nb_action"];
            $prix=$_POST["prix"];
            
            $stmt = $conn->prepare("INSERT INTO projet (titre, description, nombre_actions_a_vendre, prix_action,id_startuper)
            VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$titre, $description, $nb_action, $prix, $id_startuper]);
            header("Location: form_projet.html");
        }
    }
    else {
        header("Location: login.html");
        exit(); 
    }
?>