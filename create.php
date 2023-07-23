<?php
require_once('./include/db.php');
require_once('./include/functions.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$errors = [];
if (!empty($_POST)) {
    if (empty($_POST['username']) || !preg_match("#^[a-zA-Z0-9_]+$#", $_POST['username'])) {
        $errors['username'] = "Votre nom d'utilisateur n'est pas valide";
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    }

    if (empty($_POST['password'])) {
        $errors['password'] = "Vous devez rentrer un mot de passe";
    }

    if (empty($errors)) {
        $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $req->execute([$_POST['username'], $password, $_POST['email']]);
        $_SESSION['flash']['success'] = 'Un nouvel utilisateur a été ajouté';
        header('Location: users.php');
        exit();
    }
}

require_once './include/header.php';
?>

<div class="col-md-8 col-md-offset-2">
    <h1 style="color:#fff;">Ajouter un utilisateur</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <p>Vous n'avez pas rempli le formulaire correctement</p>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" class="form-control" name="username">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" name="email">
        </div>

        <div class="form-group">
            <label for="password">Mot de Passe</label>
            <input type="password" id="password" class="form-control" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php
require_once './include/footer.php';
