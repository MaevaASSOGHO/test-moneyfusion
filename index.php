
<?php
// Ligne 1 - Toujours commencer par le PHP
$pageTitle = "Accueil";
require 'config.php'; // Charge la configuration qui définit $db

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Vérification que la connexion existe
if (!isset($db)) {
    die("Erreur : connexion à la base de données non établie");
}

// Récupération des produits
$products = $db->query("SELECT id, name, price, image FROM products");
if (!$products) {
    die("Erreur de requête : " . $db->error);
}

require 'header.php';
?>


<div class="container">
    <h2>Nos créations artisanales</h2>
    
    <div class="products-grid">
        <?php while ($product = $products->fetch_assoc()): ?>
        <div class="product-card">
            <img src="images/products/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p class="price"><?= number_format($product['price'], 0, ',', ' ') ?> XOF</p>
            <button onclick="buyProduct(<?= $product['id'] ?>)" class="btn-buy">Acheter</button>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<style>
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }
    
    .product-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
    }
    
    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .product-card h3 {
        padding: 15px;
        font-size: 1.2rem;
    }
    
    .price {
        padding: 0 15px;
        font-weight: bold;
        color: var(--secondary);
        font-size: 1.3rem;
    }
    
    .btn-buy {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: var(--primary);
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s;
    }
    
    .btn-buy:hover {
        background-color: var(--secondary);
    }
</style>

<?php require 'footer.php'; ?>