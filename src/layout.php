<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="output.css">
</head>

<body class="bg-gray-200">
    <div class="container mx-auto p-4">
        <header>
            <nav>
                <a href="index.php" class="text-blue-500 hover:underline">
                    Utilisateurs
                </a>
                <a href="form_add.php" class="text-blue-500 hover:underline">
                    Ajouter un Utilisateur
                </a>
            </nav>
        </header>
        <main>
            <h5><?php echo $title ?></h5>
            <?php echo $content ?>
        </main>
    </div>
</body>
</html>