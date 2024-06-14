<?php
global $conn;
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécuriser et valider les données
    $permission_id = intval($_POST['permission_id']);
    $permission_name = trim($_POST['permission_name']);

    if ($permission_id > 0 && !empty($permission_name)) {
        // Mise à jour de la permission dans la base de données
        $sql_update = "UPDATE permissions SET permission_name = ? WHERE permission_id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param('si', $permission_name, $permission_id);

        if ($stmt->execute()) {
            header('location: form_permission.php');
        } else {
            echo "Erreur lors de la mise à jour de la permission : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Veuillez fournir un identifiant de permission valide et un nom de permission.";
    }
}