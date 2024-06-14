<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="output.css">
</head>

<body class="bg-gray-200 container mx-auto p-4">
        <header>
            <nav>
                <a href="index.php" class="nav-menu-item">
                    Utilisateurs
                </a>|
                <a href="form_add.php" class="nav-menu-item">
                    Ajouter un Utilisateur
                </a>
            </nav>
        </header>
        <main>
            <h1 class="text-5xl my-4"><?php echo $title ?></h1>
            <?php echo $content ?>
        </main>
</body>
</html>