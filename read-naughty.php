<?php

require_once "config/autoload.php";

$db = Database::connect();

$sql = "SELECT * FROM `supernaughty`";
// Execution de la requete
$r = $db->query($sql);

// Recupération des résultats
$supernaughtys = $r->fetchAll(PDO::FETCH_OBJ);


require_once "partials/header.php";
?>
<div class="card shadow">
    <table class="table border shadow mb-0">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Avatar</th>
                <th scope="col">Name</th>
                <th scope="col">Hobby</th>
                <th scope="col">Identity</th>
                <th scope="col">Universe</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($supernaughtys as $supernaughty): ?>
            <tr>
                <td scope="row">
                    <?= $supernaughty->id ?>
                </td>
                <td>
                    Image
                </td>
                <td>
                    <?= $supernaughty->name ?>
                </td>
                <td>
                    <?= $supernaughty->hobby ?>
                </td>
                <td>
                    <?= $supernaughty->identity ?>
                </td>
                <td>
                    <?= $supernaughty->universe ?>
                </td>
                <td>
                    <a href="#" class="btn btn-secondary">Révéler</a>           
                    <a href="./update-naughty.php?id=<?= $supernaughty->id ?>" class="btn btn-primary">Modifier</a>
                    <a href="./delete-naughty.php?id=<?= $supernaughty->id ?>" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php 
require_once "partials/footer.php"; 
?>