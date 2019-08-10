<?php
require_once "config/autoload.php";
require_once "partials/header.php";

if( $_SERVER['REQUEST_METHOD'] === "POST"){
    $photo = isset($_FILES['photo']) ? $_FILES['photo']: null;

    /*
    $upload = new Upload($image);
    $upload->handle(__DIR__.'/upload')
    */

    // Pas d'erreur dans sur l'upload
    if ($photo != null && $photo['error'] === 0)
    {
        // On récupère l'emplacement temporaire de l'image
        $tmp_name  = $image['tmp_name'];

        // On crée une dossier upload s'il n'est pas présent
        if (!is_dir(__DIR__.'/upload'))
        {
            mkdir(__DIR__.'/upload');    
        }
        
        // On génère un nom pour l'image
        $file_name = uniqid().$image;

        // On déplace le fichier temporaire dans l'emplacement voulu
        move_uploaded_file($tmp_name, __DIR__.'/upload/'.$file_name);

    }
}


?>

<form method="post" enctype="multipart/form-data">
<label for="image">Image</label>
<input type="file" name="image" class="form-control">
<button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
require_once "partials/footer.php";