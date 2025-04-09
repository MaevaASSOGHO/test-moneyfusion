<?php

// Connexion MySQL (adaptez à votre configuration)
$db = new mysqli('localhost', 'root', '', 'moneyfusion_db');
if ($db->connect_error) {
    die("Connection échouée: " . $db->connect_error);
};

// Configuration application
define('APP_CURRENCY', 'XOF'); // Devise unique (exemple pour le FCFA)
session_start();
?>
