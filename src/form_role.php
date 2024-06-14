<?php
global $conn, $result;
ob_start();
require_once 'config.php';

// Obtenir tous les rôles disponibles
$sql = "SELECT roles.role_id, role_name, GROUP_CONCAT(permission_name SEPARATOR ', ') as permissions 
        FROM roles 
        LEFT JOIN role_permission ON roles.role_id = role_permission.role_id 
        LEFT JOIN permissions ON role_permission.permission_id = permissions.permission_id 
        GROUP BY roles.role_id";
$result = $conn->query($sql);
$roles = $result->fetch_all(MYSQLI_ASSOC);
?>

    <form action="registerRoles.php" method="POST">
        Nom du rôle: <input type="text" name="role_name"><br>
        <button>Ajouter</button>
    </form>

<?php if ($result->num_rows > 0) : ?>
    <table class="roleTable">
        <tr class="text-left pl-2">
            <th>ID</th>
            <th>Nom du rôle</th>
            <th>Permissions</th>
            <th class="text-center">Supprimer</th>
        </tr>
        <?php foreach ($roles as $role) : ?>
            <tr>
                <td><?php echo $role['role_id'] ?></td>
                <td class="font-bold">
                    <a href="form_update_role.php?id=<?= $role['role_id'] ?>">
                        <?php echo $role['role_name'] ?>
                    </a>
                </td>
                <td><?php echo $role['permissions'] ?></td>
                <td class="text-center">
                    <a href="delete_role.php?id=<?php echo $role['role_id'] ?>">❌</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php else : ?>
    <p>Pas de résultats</p>
<?php endif;

$title = "Ajouter un rôle";
$content = ob_get_clean();
require 'layout.php';