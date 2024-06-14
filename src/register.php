<?php
// src/users/add.php
global $conn;
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $roles = isset($_POST['roles']) ? $_POST['roles'] : [];

    // Insérer l'utilisateur
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;

            // Insérer les rôles
            $sql_insert_role = "INSERT INTO users_roles (id, role_id) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert_role);
            if ($stmt_insert) {
                foreach ($roles as $role_id) {
                    $stmt_insert->bind_param("ii", $user_id, $role_id);
                    $stmt_insert->execute();
                }
            }

            header('location:index.php');
        } else {
            echo "Erreur : " . $sql . "<br>" . $stmt->error;
        }
    } else {
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }
}