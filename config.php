<?php

// MoneyFusion Config
define('MF_API_URL', 'https://api.moneyfusion.com/payments'); // URL réelle fournie par MoneyFusion
define('MF_API_KEY', 'https://www.pay.moneyfusion.net/BANTOU/064a9d6cb8b43645/pay/'); // À obtenir depuis votre dashboard MoneyFusion
define('MF_RETURN_URL', 'http://localhost/test-moneyfusion/success.php');

// Connexion MySQL (adaptez à votre configuration)
$db = new mysqli('localhost', 'root', '', 'moneyfusion_db');
if ($db->connect_error) {
    die("Connection échouée: " . $db->connect_error);
};

// Configuration application
define('APP_CURRENCY', 'XOF'); // Devise unique (exemple pour le FCFA)
session_start();
?>
