<?php
// A faire
//POO
// Heroe Read, Update, Delete, Create
// Naughty Read, Update, Delete, Create
// Convertir 00000x en x
// class image

require_once "config/autoload.php";

require_once "partials/header.php";
?>
<div class="card shadow">
    <table class="table border shadow mb-0">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Avatar</th>
                <th scope="col"><a href="">Name<i class="fas fa-sort ml-1"></i></a></th>
                <th scope="col"><a href="">Power<i class="fas fa-sort ml-1"></i></a></th>
                <th scope="col"><a href="">Identity<i class="fas fa-sort ml-1"></i></a></th>
                <th scope="col"><a href="">Universe<i class="fas fa-sort ml-1"></i></a></th>
                <th scope="col"><a href="">Ennemis<i class="fas fa-sort ml-1"></i></a></th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $superheroes = SuperHeroe::findAll();
    
            foreach ($superheroes as $superheroe): 
            ?>
            <tr>
                <td scope="row">
                    <?= $superheroe->id ?>
                </td>
                <td>
                    Image
                </td>
                <td>
                    <?= $superheroe->name ?>
                </td>
                <td>
                    <?= $superheroe->power ?>
                </td>
                <td>
                    <?= $superheroe->identity ?>
                </td>
                <td>
                    <?= $superheroe->universe ?>
                </td>
                <td>
                    <?php
                    $sql = "SELECT t1.name,t2.name FROM superheroe AS t1
                        INNER JOIN superheroe_has_supernaughty AS t3 ON t1.id = t3.superheroe_id
                        INNER JOIN supernaughty AS t2 ON t2.id = t3.supernaughty_id
                        WHERE t1.id =".$superheroe->id;
                    $query = Database::connect()->query($sql);
                    if ($query)
                    {
                        // Recupération des résultats
                        $supernaughtys = $query->fetchAll(PDO::FETCH_OBJ);

                        foreach ($supernaughtys as $supernaughty){
                            echo $supernaughty->name. ",";
                        }
                    }
                    ?>
                </td>
                <td>
                    <a href="#" class="btn btn-secondary">Révéler</a>           
                    <a href="./update.php?id=<?= $superheroe->id ?>" class="btn btn-primary">Modifier</a>
                    <a href="./delete.php?id=<?= $superheroe->id ?>" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php 
require_once "partials/footer.php"; 
?>