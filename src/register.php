<?php
// Version encore plus sécurisée de register.php
global $conn;
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?);";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            // echo "Nouvel utilisateur créé avec succès.";
            header("Location: index.php");
        } else {
            echo "Erreur : " . $sql . "<br>" . $stmt->error;
        }
    } else {
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }
}
