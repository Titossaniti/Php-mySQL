<?php
global $conn, $result;
ob_start();
require_once 'config.php';

// Obtenir toutes les permissions disponibles
$sql = "SELECT * FROM permissions";
$result = $conn->query($sql);
$permissions = $result->fetch_all(MYSQLI_ASSOC);
?>

<form action="registerPermissions.php" method="POST">
    Nom de la permission: <input type="text" name="permission_name" required><br>
    <button>Ajouter</button>
</form>

<?php if ($result->num_rows > 0) : ?>
    <table class="permissionTable">
        <tr class="text-left pl-2">
            <th>ID</th>
            <th>Nom de la permission</th>
            <th class="text-center">Supprimer</th>
        </tr>
        <?php foreach ($permissions as $permission) : ?>
            <tr>
                <td><?php echo $permission['permission_id'] ?></td>
                <td class="font-bold">
                    <a href="form_update_permission.php?id=<?= $permission['permission_id'] ?>">
                        <?php echo $permission['permission_name'] ?>
                    </a>
                </td>
                <td class="text-center">
                    <a href="delete_permission.php?id=<?php echo $permission['permission_id'] ?>">❌</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php else : ?>
    <p>Pas de résultats</p>
<?php endif;

$title = "Ajouter une permission";
$content = ob_get_clean();
require 'layout.php';