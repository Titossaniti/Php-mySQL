<?php
global $conn;
require_once 'config.php';

$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Erreur : " . $sql . "<br>" . $stmt->error;
    }
} else {
    echo "Erreur lors de la préparation de la requête : " . $conn->error;
}