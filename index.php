<?php

use App\Autoloader;
use App\Models\AnnonceModel;

require_once __DIR__ . ('/Autoloader.php');
Autoloader::register();

echo('<h1>Patrons de conception | Le Singleton</h>');

$model = new AnnonceModel;

echo '<pre>';
    var_dump($model);

    var_dump($model->findAll());

    var_dump($model->findBy(['id' => null, 'actif' => null]));

    var_dump($model->find('7'));
echo '</pre>';