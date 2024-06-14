<?php
global $conn;
ob_start();
require_once 'config.php';

$sql = "SELECT id, role_name FROM roles";
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom de rôle</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row["id"]; ?></td>
                <td><?= $row["role_name"]; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else : ?>
    <p>Aucun rôle</p>
<?php endif; ?>