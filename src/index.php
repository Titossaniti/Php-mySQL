<?php
// src/users/index.php
global $conn;
ob_start();
require_once 'config.php';

$sql = "SELECT users.id, username, email, GROUP_CONCAT(role_name) as role_name
FROM users
left JOIN users_roles ON users.id = users_roles.id
left JOIN roles ON users_roles.role_id = roles.role_id
GROUP BY users.id
ORDER BY 
    CASE WHEN roles.role_id IS NULL THEN 1 ELSE 0 END, 
    roles.role_id;";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($users);
?>
<?php if ($result->num_rows > 0) : ?>
    <table>
        <tr class="text-left pl-2">
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Roles</th>
            <th class="text-center">Supprimer</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td class="font-bold">
                    <a href="form_update.php?id=<?= $user['id'] ?>">
                        <?= $user['username'] ?>
                    </a>
                </td>
                <td><?= $user['email'] ?></td>
                <td>
                    <?php
                    if ($user['role_name']) :
                        $roles = explode(',', $user['role_name']);
                        foreach ($roles as $role) : ?>
                            <span class="badge <?= $role ?>"><?= $role ?></span>
                        <?php endforeach ?>
                    <?php endif ?>
                </td>
                <td class="text-center">
                    <a href="delete.php?id=<?= $user['id'] ?>">❌</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php else : ?>
    <p>Pas de résultats</p>
<?php endif;

$title = 'Liste des utilisateurs';
$content = ob_get_clean();
require 'layout.php';