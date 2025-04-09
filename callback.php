<?php
require 'config.php';

// Vérification de la signature
$receivedData = $_POST;
$receivedSignature = $receivedData['signature'];
unset($receivedData['signature']);

ksort($receivedData);
$signatureString = http_build_query($receivedData);
$expectedSignature = hash_hmac('sha256', $signatureString, MF_API_SECRET);

if (!hash_equals($expectedSignature, $receivedSignature)) {
    die('Signature invalide');
}

// Traitement de la réponse
$orderId = (int)$receivedData['order_id'];
$status = $db->real_escape_string($receivedData['status']);

$db->query("UPDATE orders SET status = '$status' WHERE id = $orderId");

// Redirection utilisateur
if ($status === 'completed') {
    header('Location: success.php');
} else {
    header('Location: cancel.php');
}