<?php
require_once('./include/db.php');
require_once('./include/functions.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Get user details
if (isset($_GET['id'])) {
    $req = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $req->execute([$_GET['id']]);
    $user = $req->fetch(PDO::FETCH_OBJ);

    if (!$user) {
        $_SESSION['flash']['danger'] = "L'utilisateur demandé n'existe pas";
        header('Location: users.php');
        exit();
    }
} else {
    header('Location: users.php');
    exit();
}

// Update user details
if (!empty($_POST)) {
    $username = strip_tags($_POST['username']);
    $email = strip_tags($_POST['email']);
    
    $req = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $req->execute([$username, $email, $user->id]);

    $_SESSION['flash']['success'] = "L'utilisateur a été mis à jour avec succès";
    header('Location: users.php');
    exit();
}

require_once '../include/header.php';
?>

<div class="container">
    <h1>Modifier Utilisateur</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" class="form-control" name="username" value="<?= $user->username; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" name="email" value="<?= $user->email; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

<?php require_once '../include/footer.php'; ?>
