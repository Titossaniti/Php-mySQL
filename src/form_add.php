<?php
// src/users/form_add.php
global $conn;
ob_start();
require_once 'config.php';

// Obtenir tous les rôles disponibles
$sql_roles = "SELECT role_id, role_name FROM roles";
$result_roles = $conn->query($sql_roles);
$roles = $result_roles->fetch_all(MYSQLI_ASSOC);
?>

    <form action="register.php" method="POST">
        Nom d'utilisateur: <input type="text" name="username"><br>
        Email: <input type="email" name="email"><br>
        Mot de passe: <input type="password" name="password"><br>
        Rôles:<br>
        <?php foreach ($roles as $role): ?>
            <label>
                <input type="checkbox" name="roles[]" value="<?= $role['role_id'] ?>">
                <?= $role['role_name'] ?>
            </label><br>
        <?php endforeach; ?>
        <button>Ajouter</button>
    </form>

<?php
$title = "Ajouter un utilisateur";
$content = ob_get_clean();
require 'layout.php';