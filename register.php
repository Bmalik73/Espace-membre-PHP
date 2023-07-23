<?php
require_once ('./include/db.php');
require_once ('./include/functions.php');
session_start();

if (!empty($_POST)) {
    $errors = [];
    if (empty($_POST['username']) || !preg_match("#^[a-zA-Z0-9_]+$#", $_POST['username'])) {
        $errors['username'] = "Votre nom d'utilisateur n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        if ($user) {
            $errors['username'] = 'Ce nom d\'utilisateur est déjà pris';
        }
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if ($user) {
            $errors['email'] = 'Cet email est déjà utilisé pour un autre compte';
        }
    }

    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $errors['password'] = "Vous devez rentrer un mot de passe valide et confirmé";
    }
    if (empty($errors)) {
        $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = generationToken(60);
        $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
        $user_id = $pdo->lastInsertId();
        mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost:8888/confirm.php?id=$user_id&token=$token");
        $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
        header('Location: login.php');
        exit();
    }
}
?>

<?php
require_once './include/header.php';
?>

<div class="col-md-8 col-md-offset-2" >
    <h1 style="color:#fff;">S'inscrire</h1>

    <?php if (isset($_SESSION['flash']['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['flash']['success']; ?>
        </div>
    <?php 
        unset($_SESSION['flash']['success']); // ne pas oublier de le supprimer après l'avoir utilisé
    endif; 
    ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <p>Vous n'avez pas rempli le formulaire correctement</p>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <fieldset>
            <div class="form-group">
                <label for="pseudo">Nom d'utilisateur</label>
                <input type="text" id="pseudo" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" id="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="password">Mot de Passe</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="password">Confirmation du Mot de Passe</label>
                <input type="password" id="password" class="form-control" name="password_confirm">
            </div>
            <input type="submit" class="btn btn-primary" value="S'inscrire">
        </fieldset>
    </form> 
</div>

<?php
require_once './include/footer.php';
?>
