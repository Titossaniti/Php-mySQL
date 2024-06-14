<?php
ob_start();
require 'config.php';
?>

<form action="register.php" method="post">
    Nom d'utilisateur: <input type="text" name="username"><br>
    Email: <input type="email" name="email"><br>
    Mot de passe: <input type="password" name="password"><br>
    <button>S'inscrire</button>
</form>

<?php
$title = "Inscription";
$content = ob_get_clean();
require 'layout.php';
