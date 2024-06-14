<?php
// src/users/update.php
global $conn;
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $roles = isset($_POST['roles']) ? $_POST['roles'] : [];

    // Mettre à jour les informations de l'utilisateur
    $sql = "UPDATE users SET username=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssi", $username, $email, $id);
        if ($stmt->execute()) {
            // Supprimer les rôles actuels de l'utilisateur
            $sql_delete_roles = "DELETE FROM users_roles WHERE id=?";
            $stmt_delete = $conn->prepare($sql_delete_roles);
            if ($stmt_delete) {
                $stmt_delete->bind_param("i", $id);
                $stmt_delete->execute();
            }

            // Insérer les nouveaux rôles
            $sql_insert_role = "INSERT INTO users_roles (id, role_id) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert_role);
            if ($stmt_insert) {
                foreach ($roles as $role_id) {
                    $stmt_insert->bind_param("ii", $id, $role_id);
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