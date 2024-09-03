<?php

use App\Autoloader;
use App\Models\AnnonceModel;

require_once __DIR__ . ('/Autoloader.php');
Autoloader::register();

// echo('<h1>Patrons de conception | Le Singleton</h>');

// J'instancie un objet de typa AnnonceModel dans la variable $model
$model = new AnnonceModel;

/*  J'appelle les setters de la classe AnnonceModel et je définis les valeurs 
    des propriétés de l'objet puis je le stoque dans la variable $annonce */
// $annonce = $model;
    // ->setTitre('Annonce Nouvelle')
    // ->setDescription('Déscription Nouvelle')
    // ->setActif(0);
    

/*  J'appelle la méthode create de la classe AnnonceModel et lui passe 
    l'objet $annonce qui contient les valeurs */
// $model->create($annonce);

// Je crée une annonce avec les données venant d'un tableau tel que $_POST (c'est à dire d'un formulaire)

$donnees = [
    'titre' => 'Titre annonce hydratée',
    'description' => 'Description de l\'annonce hydratée',
    'actif' => 1
];

$annonce = $model->hydrate($donnees);
$model->create($annonce);

echo '<pre>';
    // var_dump($model);

    // var_dump($model->findAll());

    // var_dump($model->findBy(['id' => null, 'actif' => null]));

    // var_dump($model->find(7));

    var_dump($annonce);
echo '</pre>';