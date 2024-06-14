<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role_name = $_POST['role_name'];
    $sql = "INSERT INTO roles (role_name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $role_name);
        if ($stmt->execute()) {
            header("Location: .php");
        } else {
            echo "Erreur : " . $sql . "<br>" . $stmt->error;
        }
    } else {
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }
}
