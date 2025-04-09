<?php
require 'config.php';
header('Content-Type: application/json');

// 1. Vérifications de sécurité
if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    echo json_encode(['statut' => false, 'message' => 'Accès non autorisé']);
    exit;
}

// 2. Récupération du produit
$productId = (int)$_POST['product_id'];
$product = $db->query("SELECT * FROM products WHERE id = $productId")->fetch_assoc();

if (!$product) {
    http_response_code(404);
    echo json_encode(['statut' => false, 'message' => 'Produit introuvable']);
    exit;
}

// 3. Formatage pour MoneyFusion (selon leur doc)
$paymentData = [
    'totalPrice' => $product['price'],
    'article' => [ [ $product['name'] => $product['price'] ], // Format exigé
    'numeroSend' => $_SESSION['user_phone'] ?? '', // Obligatoire
    'nomclient' => $_SESSION['user_name'] ?? '', // Obligatoire
    'personal_Info' => [
        'userId' => $_SESSION['user_id'],
        'orderId' => 'BANTOU_' . uniqid()
    ],
    'return_url' => MF_RETURN_URL
];

// 4. Envoi à MoneyFusion via Axios (côté serveur)
try {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => MF_API_ENDPOINT,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($paymentData),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . MF_API_KEY
        ]
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // 5. Traitement réponse
    $responseData = json_decode($response, true);
    
    if ($httpCode !== 200 || !isset($responseData['url'])) {
        throw new Exception($responseData['message'] ?? 'Erreur API');
    }

    // 6. Sauvegarde en BDD (adaptée à votre structure)
    $db->query("INSERT INTO orders 
               (user_id, total_amount, status, moneyfusion_id) 
               VALUES (
                   {$_SESSION['user_id']}, 
                   {$product['price']}, 
                   'pending', 
                   '{$responseData['token']}'
               )");

    // 7. Retour réussite (format MoneyFusion)
    echo json_encode([
        'statut' => true,
        'token' => $responseData['token'],
        'message' => 'Paiement initié',
        'url' => $responseData['url']
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'statut' => false,
        'message' => 'Échec du paiement: ' . $e->getMessage()
    ]);
}
?>