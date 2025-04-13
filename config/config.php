<?php
// /config/config.php
return [
    'db' => [
        'host'    => 'localhost',
        'dbname'  => 'gestionde_parc_jul',
        'user'    => 'bob',
        'pass'    => 'bobi',
        'charset' => 'utf8mb4'
    ],
    'roles' => [
        'admin', // accès complet
        'user'   // accès limité
    ],
    'base_url' => '/projet-gestion-parc/public'
];
