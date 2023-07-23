<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
</head>
<body>
    <h1>Bienvenue sur votre tableau de bord, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h1>
    <p>Ceci est votre tableau de bord sécurisé.</p>
</body>
</html>
