<?php
// Default local (dev) settings
$serveur = 'localhost';
$bdd     = 'jo_paris';
$user    = 'root';
$mdp     = 'root';

// If running inside Docker (container), use the compose DB service and credentials
// We detect Docker by the presence of /.dockerenv. If you prefer env vars, you
// can set them in the compose file and the script will prefer those.
if (file_exists('/.dockerenv')) {
    // Service name in docker-compose is `db` and credentials are declared there
    $serveur = 'db';
    $bdd     = 'jo_tourisme_db';
    $user    = 'jo_tourisme';
    $mdp     = 'jo_tourisme_pass';
}

// Allow overriding via environment variables if present
$env_host = getenv('DB_HOST') ?: getenv('MYSQL_HOST');
if ($env_host) {
    $serveur = $env_host;
}
$env_db = getenv('DB_DATABASE') ?: getenv('MYSQL_DATABASE');
if ($env_db) {
    $bdd = $env_db;
}
$env_user = getenv('DB_USER') ?: getenv('MYSQL_USER');
if ($env_user) {
    $user = $env_user;
}
$env_pass = getenv('DB_PASSWORD') ?: getenv('MYSQL_PASSWORD');
if ($env_pass) {
    $mdp = $env_pass;
}

// You can use $serveur, $bdd, $user, $mdp when constructing your PDO connection.

$serveur2 = $serveur;
$mdp2 = $mdp;
?>

