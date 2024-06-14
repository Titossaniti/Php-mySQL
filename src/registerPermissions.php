<?php
global $conn;
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $permission_name = $_POST['permission_name'];
    $sql = "INSERT INTO permissions (permission_name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $permission_name);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Erreur : " . $sql . "<br>" . $stmt->error;
        }
    }
}
