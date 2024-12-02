<?php

return [

        'paths' => ['api/*'],  // On cible les routes API, modifie si nécessaire.

        'allowed_methods' => ['*'],  // Permet toutes les méthodes (GET, POST, etc.)

        'allowed_origins' => [
            'http://127.0.0.1:5500',  // Frontend sur localhost, port 5500
        ],

        'allowed_origins_patterns' => [],

        'allowed_headers' => ['*'],  // Permet tous les en-têtes

        'exposed_headers' => [],

        'max_age' => 0,

        'supports_credentials' => false,  // Peut être à true si tu utilises des cookies ou des sessions partagées
];
