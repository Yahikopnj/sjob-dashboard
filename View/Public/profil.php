<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    if($_SESSION["admin"] == 0): ?>

        <a href="../../index.php">accueil</a>

    <?php

     elseif($_SESSION["admin"] == 1): ?>

        <a href="../../Controller/Router.php?action=all">voir les utilisateurs</a>

    <?php endif; ?>
    
</body>
</html>