<?php
require_once('./include/db.php');
require_once('./include/functions.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Delete user
if (isset($_GET['id'])) {
    $req = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $req->execute([$_GET['id']]);
    $_SESSION['flash']['success'] = "L'utilisateur a été supprimé avec succès";
} else {
    $_SESSION['flash']['danger'] = "Aucun utilisateur spécifié";
}

header('Location: users.php');
exit();
