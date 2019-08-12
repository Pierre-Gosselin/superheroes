<?php

class Upload
{
    private $name;
    private $tmpName;
    private $error;
    private $type;
    private $size;


    public function hydrate($image)
    {
        if ($image != null && $image['error'] === 0)
        {
            $this->name = $image['name'];
            // On récupère l'emplacement temporaire de l'image
            $this->tmpName = $image['tmp_name'];
            $this->error = $image['error'];
            $this->type = $image['type'];
            $this->size = $image['size'];
        }
    }

    public function __construct($image)
    {
        $this->hydrate($image);
    }

    // Manipulation de l'image
    public function handle($dir)
    {
        
        // On crée une dossier upload s'il n'est pas présent
        if (!is_dir($dir))
        {
            mkdir($dir);    
        }
        
        // On génère un nom pour l'image
        $file_name = uniqid().$this->name;
        // On déplace le fichier temporaire dans l'emplacement voulu
        move_uploaded_file($this->tmpName, $dir."/".$file_name);
    
        $this->name = $dir."/".$file_name;
    }

    public function read()
    {
        return $this->name;
    }
}