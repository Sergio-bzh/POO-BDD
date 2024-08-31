<?php
namespace App;

class Autoloader
{
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    // Fonction de rappel passée en deuxième paramètre à la fonction PHP spl_autoload_register()
    // Cette fonction récupère le chemin complet d'une classe avec son namespace (App\Client\Compte)
    static function autoload($class)
    {
        // Je remplace le namespace et le backslash par une chaine vide et je stocke le tout dans la variable $class
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);

        // Je remplace les \ par des / et je les mets dans une variable $fichier
        $class = str_replace('\\', '/', $class);

        // Je mets le chemin complet vers le fichier dans la variable $fileInPath
        $fileInPath = __DIR__ . '/' . $class . '.php';

        // Je vérifie si le fichier php existe et si oui, on le require
        if(file_exists($fileInPath)){
            require_once $fileInPath;
        }
    }
}