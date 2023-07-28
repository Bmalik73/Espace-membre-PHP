<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once './include/db.php';
session_start();

if (!empty($_POST)) {
    $errors = [];

    if (empty($_POST['username']) || !preg_match("/^[a-zA-Z0-9_]+$/", strip_tags($_POST['username']))) {
        $errors['username'] = "Votre nom d'utilisateur n'est pas valide";
    } 

    if (empty($_POST['password'])) {
        $errors['password'] = "Vous devez rentrer un mot de passe";
    }

    if (empty($errors)) {
        $req = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $req->execute([$_POST['username']]);
        $user = $req->fetch();

        if ($user && password_verify($_POST['password'], $user->password)) {

            // Enregistrement de l'utilisateur dans la session
            $_SESSION['user'] = [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email
            ];
        
            // Redirection vers une page sécurisée (dashboard.php)
            header('Location: admin/dashboard.php');
            exit();
        } else {
            // Gestion des cas où le nom d'utilisateur n'existe pas ou le mot de passe est incorrect
            $errors['login'] = 'Nom d\'utilisateur ou mot de passe incorrect';
        }
        
    }
}

require_once './include/header.php';
?>

<div class="col-md-8 col-md-offset-2" >
    <h1 style="color:#fff;">Connexion</h1>

    <?php if(!empty($errors)): ?>
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
        <fieldset>
            <div class="form-group">
                <label for="pseudo">Nom d'utilisateur</label>
                <input type="text" id="pseudo" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="password">Mot de Passe</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>
            <input type="submit" class="btn btn-primary" value="Se connecter">
        </fieldset>
    </form> 
</div>

<?php
require_once './include/footer.php';
?>
