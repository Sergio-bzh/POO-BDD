<?php

use App\Autoloader;
use App\Models\AnnonceModel;

require_once __DIR__ . ('/Autoloader.php');
Autoloader::register();

echo('<h1>Patrons de conception | Le Singleton</h>');

$model = new AnnonceModel;

echo '<pre>';
    var_dump($model);
echo '</pre>';