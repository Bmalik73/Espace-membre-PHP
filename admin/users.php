<?php
require_once ('../include/db.php');
require_once ('../include/functions.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$req = $pdo->prepare("SELECT * FROM users");
$req->execute();
$users = $req->fetchAll(PDO::FETCH_OBJ);

require_once './include/header.php';
?>

<div class="container">
    <h1>Liste des utilisateurs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id; ?></td>
                <td><?= $user->username; ?></td>
                <td><?= $user->email; ?></td>
                <td>
                    <a href="admin/edit.php?id=<?= $user->id; ?>" class="btn btn-info">Modifier</a>
                    <a href="admin/delete.php?id=<?= $user->id; ?>" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once './include/footer.php'; ?>
