<?php
require 'config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Accès non autorisé']);
    exit;
}

$productId = (int)$_POST['product_id'];
$product = $db->query("SELECT * FROM products WHERE id = $productId")->fetch_assoc();

if (!$product) {
    echo json_encode(['success' => false, 'error' => 'Produit introuvable']);
    exit;
}

// Création de la commande
$db->query("INSERT INTO orders (user_id, total_amount, status) 
            VALUES ({$_SESSION['user_id']}, {$product['price']}, 'pending')");
$orderId = $db->insert_id;

// Préparation du paiement MoneyFusion
$paymentData = [
    'amount' => $product['price'],
    'currency' => APP_CURRENCY,
    'order_id' => $orderId,
    'description' => 'Achat: '.$product['name'],
    'customer_id' => $_SESSION['user_id'],
    'return_url' => MF_RETURN_URL,
    'cancel_url' => MF_CANCEL_URL,
    'timestamp' => time()
];

// Génération de la signature
ksort($paymentData);
$signatureString = http_build_query($paymentData);
$paymentData['signature'] = hash_hmac('sha256', $signatureString, MF_API_SECRET);
$paymentData['api_key'] = MF_API_KEY;

// Envoi à MoneyFusion
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => MF_API_ENDPOINT,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($paymentData),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded']
]);

$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);
if ($responseData && $responseData['payment_url']) {
    // Sauvegarde l'ID de transaction MoneyFusion
    $db->query("UPDATE orders SET moneyfusion_id = '{$responseData['transaction_id']}' WHERE id = $orderId");
    echo json_encode(['success' => true, 'payment_url' => $responseData['payment_url']]);
} else {
    echo json_encode(['success' => false, 'error' => 'Erreur MoneyFusion']);
}