<?php
ob_start();
global $conn;
require_once 'config.php';
$id = $_GET['id'];
$sql =
    "SELECT u.id, username ,email, r.role_name
        FROM users u
        JOIN users_roles ur ON u.id = ur.id
        JOIN roles r ON ur.role_id = r.role_id
        WHERE u.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>
<form action="updateRoles.php" method="post">
    ID: <input type="text" name="id" value="<?= htmlspecialchars($user['id']) ?>" readonly><br>
    Role : <select name="role_name" id="role_name">
        <option value="Admin" <?= $user['role_name'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
        <option value="Editor" <?= $user['role_name'] == 'Editor' ? 'selected' : '' ?>>Editor</option>
        <option value="Viewer" <?= $user['role_name'] == 'Viewer' ? 'selected' : '' ?>>Viewer</option>
        <option value="Contributor" <?= $user['role_name'] == 'Contributor' ? 'selected' : '' ?>>Contributor</option>
        <option value="Moderator" <?= $user['role_name'] == 'Moderator' ? 'selected' : '' ?>>Moderator</option>
    </select>
    <button>Mettre à jour</button>
</form>
<?php $title = "Modifier le rôle de l'utilisateur";
$content = ob_get_clean();
require_once 'layout.php';