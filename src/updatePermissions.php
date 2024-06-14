<?php
global $conn;
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $permission_name = $_POST['permission_name'];
    $sql = "UPDATE permissions SET permission_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("si", $permission_name, $id);
        if ($stmt->execute()) {
            header("Location: .php");
        } else {
            echo "Erreur : " . $sql . "<br>" . $stmt->error;
        }
    } else {
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }
}
