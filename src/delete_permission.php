<?php
global $conn;
require_once 'config.php';

if (isset($_GET['id'])) {
    $permission_id = intval($_GET['id']);

    if ($permission_id > 0) {
        // Suppression de la permission dans la base de données
        $sql_delete = "DELETE FROM permissions WHERE permission_id = ?";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bind_param('i', $permission_id);

        if ($stmt->execute()) {
            header('location: form_permission.php');
        } else {
            echo "Erreur lors de la suppression de la permission : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Identifiant de permission invalide.";
    }
} else {
    echo "Identifiant de permission non fourni.";
}