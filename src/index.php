<?php
global $conn;
ob_start();
require 'config.php';

$sql =
    "SELECT u.id, username ,email, role_name
        FROM users u
        LEFT JOIN users_roles ur ON u.id = ur.id
        LEFT JOIN roles r ON ur.role_id = r.role_id
        ORDER BY role_name ASC";
$result = $conn->query($sql);
?>
<?php if ($result->num_rows > 0) : ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Delete</th>
            <th>Role</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row["id"]; ?></td>
                <td>
                    <a href="form_update.php?id=<?= $row["id"]?>">
                        <?= $row["username"]; ?>
                    </a>
                </td>
                <td><?= $row["email"]; ?></td>
                <td>
                    <a href="delete.php?id=<?= $row["id"]?>">❌</a>
                </td>
                <td>
                    <a href="form_update_role.php?id=<?= $row["id"]?>">
                        <?= $row["role_name"]; ?>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else : ?>
    <p>0 résultats</p>
<?php endif;

$title = "Liste des utilisateurs";
$content = ob_get_clean();
require 'layout.php';
