<?php
session_start();
include 'database.php';
if(isset($_SESSION['id_startuper'])){


	$id_startuper = $_SESSION["id_startuper"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST["action"] == "editer") {
            $titre = $_POST["titre"];
            $description = $_POST["description"];
            $nb_action = $_POST["nb_action"];
            $prix = $_POST["prix"];
            $id=$_REQUEST["id"];
            $stmt = $conn->prepare("UPDATE projet SET titre=?, description=?, nombre_actions_a_vendre=?, prix_action=? WHERE id_projet=?");
            $stmt->bindParam(1, $titre);
            $stmt->bindParam(2, $description);
            $stmt->bindParam(3, $nb_action);
            $stmt->bindParam(4, $prix);
            $stmt->bindParam(5, $id);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                header("Location: lister_projet.php?success=Edited Successfully");
                exit(); 
            } else {
                header("Location: editer_projet.php?error=Failed to edit project");
                exit(); 
            }
        }
        elseif($_POST["action"] == "supprimer") {
            $id=$_REQUEST["id"];
            $stmt2 = $conn->prepare("SELECT nombre_action_vendues FROM projet WHERE id_projet=?");
            $stmt2->bindParam(1, $id);
            $stmt2->execute();
            $res = $stmt2->fetch(PDO::FETCH_ASSOC);
            $nb_action_v = $res["nombre_action_vendues"];

            if($nb_action_v == 0) {
                $delete = $conn->prepare("DELETE FROM projet WHERE id_projet=? AND id_startuper=?");
                $delete->bindParam(1, $id);
                $delete->bindParam(2, $id_startuper);
                $delete->execute();

                if($delete->rowCount() > 0) {
                    header("Location: lister_projet.php?success=Projet supprimé ");
                    exit(); 
                } 
            } else {
                header("Location: editer_projet.php?error=action_vendue");
                exit(); 
            }
        }
        else {




            header("Location: editer_projet.php?error=Invalid action");
            exit(); 
        }
    }
    }
    else{
        header("Location:welcome.php?error=UnAuthorized Access");
    }
?>

