<?php
session_start();
include("database.php");

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["pwrd"];
        $role = $_POST['role'];
        if($role =="Capital_Risque"){

            $stmt = $conn->prepare("SELECT id_capital_risque FROM capital_risque WHERE pseudo = :username AND pwrd = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_capital_risque = $row['id_capital_risque'];
                $_SESSION["id_capital_risque"] = $id_capital_risque;
                $_SESSION["role"] = "capital_risque";
                
                
                header("Location: capital.html");
                
            } else {
                echo "Invalid username or password.";
            }
        }
        else{
            $stmt = $conn->prepare("SELECT id_startuper FROM startuper WHERE pseudo = :username AND pwrd = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_startuper = $row['id_startuper'];
                $_SESSION["id_startuper"] = $id_startuper;
                $_SESSION["role"] = "startuper";
                
                header("Location: start2.html");
                
            } else {
                echo "Invalid username or password.";
            }
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>