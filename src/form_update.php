<?php
global $conn;
ob_start();
require_once 'config.php';
$id = $_GET['id'];
$sql = "SELECT id, username, email FROM users WHERE id=$id";
$result  = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<form action="update.php" method="post">
    ID: <input type="text" name="id" value="<?= $_GET['id'] ?>"><br>
    Nom d'utilisateur: <input type="text" name="username" value="<?= $user['username'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $user['email'] ?>"><br>
    <button>Mettre à jour</button>
</form>

<?php
$title = "Modifier l'utilisateur";
$content = ob_get_clean();
require_once 'layout.php';
