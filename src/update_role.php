<?php
global $conn;
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécuriser et valider les données
    $role_id = intval($_POST['role_id']);
    $role_name = trim($_POST['role_name']);

    if ($role_id > 0 && !empty($role_name)) {
        // Mise à jour du rôle dans la base de données
        $sql_update = "UPDATE roles SET role_name = ? WHERE role_id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param('si', $role_name, $role_id);

        if ($stmt->execute()) {
            header('location: form_role.php');
        } else {
            echo "Erreur lors de la mise à jour du rôle : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Veuillez fournir un identifiant de rôle valide et un nom de rôle.";
    }
}