<?php
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/oauth2-server-php/src/';
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    } else {
        throw new Exception("Fichier introuvable pour la classe/interface : $class. Vérifiez le chemin : $file");
    }
});
