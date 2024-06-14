<?php
global $conn;
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET username=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssi", $username, $email, $id);
        if ($stmt->execute()) {
            // echo "Utilisateur mis à jour avec succès";
            header("Location: index.php");
        } else {
            echo "Erreur : " . $sql . "<br>" . $stmt->error;
        }
    } else {
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }
}

