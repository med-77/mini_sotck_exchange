<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acheter'])) {
    // Vérifiez les données envoyées par le formulaire
    $id_projet = $_POST['id_projet']; // Récupérer l'ID du projet depuis l'URL
    $id_capital_risque = $_SESSION['id_capital_risque']; // Récupérer l'ID du capital-risque depuis la session
    $nombre_actions_achetees = $_POST['nb_actions']; // Récupérer le nombre d'actions achetées depuis le formulaire

    // Insérez les informations dans la table capital_risque_projet
    $stmt = $conn->prepare("INSERT INTO capital_risque_projet (id_projet, id_capital_risque, nombre_actions_achetees) VALUES (?, ?, ?)");
    $stmt->bindParam(1, $id_projet, PDO::PARAM_INT);
    $stmt->bindParam(2, $id_capital_risque, PDO::PARAM_INT);
    $stmt->bindParam(3, $nombre_actions_achetees, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Mettez à jour les colonnes nombre_actions_a_vendre et nombre_action_vendues dans la table projet
        $stmt_update = $conn->prepare("UPDATE projet SET nombre_actions_a_vendre = nombre_actions_a_vendre - ?, nombre_action_vendues = nombre_action_vendues + ? WHERE id_projet = ?");
        $stmt_update->bindParam(1, $nombre_actions_achetees, PDO::PARAM_INT);
        $stmt_update->bindParam(2, $nombre_actions_achetees, PDO::PARAM_INT);
        $stmt_update->bindParam(3, $id_projet, PDO::PARAM_INT);
        $stmt_update->execute();

        // Redirection vers une page de confirmation ou de succès
        header("Location: confirmation_achat.php?success=Achat réussi");
        exit();
    } else {
        // En cas d'échec de l'insertion
        header("Location: confirmation_achat.php?error=Echec de l'achat");
        exit();
    }
} else {
    // Redirection en cas d'accès direct à cette page sans formulaire
    header("Location: welcome.html?error=Accès non autorisé");
    exit();
}
?>
