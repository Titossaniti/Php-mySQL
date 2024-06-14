<?php
// src/users/form_update.php
global $conn;
ob_start();
require_once 'config.php';

$id = $_GET['id'];

// Obtenir les informations de l'utilisateur
$sql = "SELECT id, username, email FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Obtenir tous les rôles disponibles
$sql_roles = "SELECT role_id, role_name FROM roles";
$result_roles = $conn->query($sql_roles);
$roles = $result_roles->fetch_all(MYSQLI_ASSOC);

// Obtenir les rôles de l'utilisateur
$sql_user_roles = "SELECT role_id FROM users_roles WHERE id = $id";
$result_user_roles = $conn->query($sql_user_roles);
$user_roles = $result_user_roles->fetch_all(MYSQLI_ASSOC);
$user_roles_ids = array_column($user_roles, 'role_id');
?>

    <form action="update.php" method="post">
        ID:
        <input type="text" name="id" value="<?= $id ?>" readonly><br>
        Nom d'utilisateur:
        <input type="text" name="username" value="<?= $user['username'] ?>"><br>
        Email:
        <input type="email" name="email" value="<?= $user['email'] ?>"><br>
        Rôles:<br>
        <?php foreach ($roles as $role): ?>
            <label>
                <input type="checkbox" name="roles[]" value="<?= $role['role_id'] ?>"
                    <?= in_array($role['role_id'], $user_roles_ids) ? 'checked' : '' ?>>
                <?= $role['role_name'] ?>
            </label><br>
        <?php endforeach; ?><br>
        <button>Mettre à jour</button>
    </form>
    <a href="index.php">Annuler</a>
<?php
$title = "Modification d'utilisateur";
$content = ob_get_clean();
require 'layout.php';