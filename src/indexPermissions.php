<?php
global $conn;
ob_start();
require 'config.php';

$sql = "SELECT permission_id, permission_name FROM permissions";
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table>
        <tr>
            <th>Permissions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row["permission_name"]; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else : ?>
    <p>No permissions found.</p>
<?php endif;
$title = "Gérer les permissions";
$content = ob_get_clean();
require 'layout.php';
