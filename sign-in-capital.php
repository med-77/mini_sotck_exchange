<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $CIN=$_POST['CIN'];
    $pseudo=$_POST['pseudo'];
    $pwrd=$_POST['mdp'];
    //$hashed_pwrd = password_hash($pwrd, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO capital_risque (nom, prenom, email, CIN, pseudo, pwrd) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $prenom);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $CIN);
    $stmt->bindParam(5, $pseudo);
    $stmt->bindParam(6, $pwrd);

    if($stmt->execute()){
        header("Location: sign-up-success.html");
    } else {
        echo "Erreur lors de l'insertion des données.";
    }
}

$conn = null; 
?>
