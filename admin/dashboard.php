<?php
require_once('../include/db.php');
require_once('../include/functions.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$req = $pdo->query('SELECT * FROM users');
$users = $req->fetchAll(PDO::FETCH_ASSOC);

require_once '../include/header.php';
?>

<div class="col-md-8 col-md-offset-2">
    <h1 style="color:#fff;">Dashboard</h1>

    <p>Bienvenue <?= $_SESSION['user']['username'] ?> !</p>

    <h2>Liste des utilisateurs</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                        <a href="/admin/edit.php?id=<?= $user['id'] ?>" class="btn btn-warning">Editer</a>
                        <a href="/admin/delete.php?id=<?= $user['id'] ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/admin/create.php" class="btn btn-success">Ajouter un utilisateur</a>
</div>

<?php
require_once '../include/footer.php';
