<?php
// src/roles/delete_role.php
global $conn;
require_once 'config.php';

if (isset($_GET['id'])) {
    $role_id = intval($_GET['id']);

    // Supprimer les associations de permissions dans roles_permissions
    $sql = "DELETE FROM role_permission WHERE role_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $role_id);
    $stmt->execute();

    // Supprimer les associations d'utilisateurs dans users_roles
    $sql = "DELETE FROM users_roles WHERE role_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $role_id);
    $stmt->execute();

    // Supprimer le rôle dans roles
    $sql = "DELETE FROM roles WHERE role_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $role_id);
    $stmt->execute();

    header("Location: form_role.php");
    exit();
} else {
    echo "ID de rôle non spécifié.";
}