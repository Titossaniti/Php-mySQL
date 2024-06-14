<?php
global $conn;
require_once 'config.php';

if (isset($_GET['id'])) {
    $role_id = intval($_GET['id']);

    // Obtenir les détails du rôle
    $sql_role = "SELECT role_id, role_name FROM roles WHERE role_id = ?";
    $stmt = $conn->prepare($sql_role);
    $stmt->bind_param('i', $role_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $role = $result->fetch_assoc();
    } else {
        echo "Rôle non trouvé.";
        exit;
    }

    $stmt->close();
} else {
    echo "Identifiant du rôle non fourni.";
    exit;
}
?>

<form method="post" action="update_role.php">
    <input type="hidden" name="role_id" value="<?php echo $role['role_id'] ?>">
    <label for="role_name">Nom du rôle :</label>
    <input type="text" id="role_name" name="role_name" value="<?php echo htmlspecialchars($role['role_name']) ?>" required>
    <button type="submit">Mettre à jour</button>
</form>
<a href="form_role.php">Annuler</a>

<?php
$title = 'Modifier un rôle';
$content = ob_get_clean();
require 'layout.php';