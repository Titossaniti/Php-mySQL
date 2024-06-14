<?php
global $conn;
require_once 'config.php';

if (isset($_GET['id'])) {
    $permission_id = intval($_GET['id']);

    // Obtenir les détails de la permission
    $sql_permission = "SELECT permission_id, permission_name FROM permissions WHERE permission_id = ?";
    $stmt = $conn->prepare($sql_permission);
    $stmt->bind_param('i', $permission_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $permission = $result->fetch_assoc();
    } else {
        echo "Permission non trouvée.";
        exit;
    }

    $stmt->close();
} else {
    echo "Identifiant de la permission non fourni.";
    exit;
}
?>

<form method="post" action="update_permission.php">
    <input type="hidden" name="permission_id" value="<?php echo $permission['permission_id'] ?>">
    <label for="permission_name">Nom de la permission :</label>
    <input type="text" id="permission_name" name="permission_name" value="<?php echo htmlspecialchars($permission['permission_name']) ?>" required>
    <button type="submit">Mettre à jour</button>
</form>
<a href="form_permission.php">Annuler</a>

<?php
$title = 'Modifier une permission';
$content = ob_get_clean();
require 'layout.php';