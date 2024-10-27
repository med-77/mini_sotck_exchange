<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom=$_POST['nom'];
    $prenom=$_POST['Prenom'];
    $email=$_POST['email'];
    $CIN=$_POST['CIN'];
    $nom_ese=$_POST['nom_entreprise'];
    $adresse_ese=$_POST['adresse_entreprise'];
    $num_registre_comm=$_POST['num_registre_comm'];
    $img = file_get_contents($_FILES["Photo"]["tmp_name"]);
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $req = $conn->prepare("INSERT INTO startuper (nom, prenom, cin, email, nom_entreprise, adresse_entreprise, numero_registre_commerce,photo,  pseudo, pwrd) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    $req->bindParam(1, $nom);
    $req->bindParam(2, $prenom);
    $req->bindParam(3, $CIN);
    $req->bindParam(4, $email);
    $req->bindParam(5, $nom_ese);
    $req->bindParam(6, $adresse_ese);
    $req->bindParam(7, $num_registre_comm);
    $req->bindParam(8, $img);
    $req->bindParam(9, $pseudo);
    $req->bindParam(10, $mdp);

    if($req->execute()){
        header("Location: sign-up-success.html");
    } else {
        echo "Erreur lors de l'insertion des données.";
    }
}

$conn = null;
?>
