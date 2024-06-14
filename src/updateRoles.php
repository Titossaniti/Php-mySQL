<?php
global $conn;
require_once 'config.php';

// Récupérer les données du formulaire
$id = $_POST['id'];
$role_name = $_POST['role_name'];

// Trouver l'id du rôle basé sur le nom du rôle
$sql = "SELECT role_id FROM roles WHERE role_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $role_name);
$stmt->execute();
$result = $stmt->get_result();
$role = $result->fetch_assoc();
$stmt->close();

if ($role) {
    $role_id = $role['role_id'];

    // Mettre à jour le rôle de l'utilisateur
    $sql_update = "UPDATE users_roles SET role_id = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    if ($stmt_update) {
        $stmt_update->bind_param("ii", $role_id, $id);
        if ($stmt_update->execute()) {
            // Rediriger vers index.php après succès
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de l'exécution de la mise à jour : " . $stmt_update->error;
        }
        $stmt_update->close();
    } else {
        echo "Erreur lors de la préparation de la requête de mise à jour : " . $conn->error;
    }
} else {
    echo "Rôle non trouvé.";
}
$conn->close();