<?php 
$pageTitle = "Merci !";
require 'header.php'; 
?>

<div class="container success-page">
    <div class="success-icon">✓</div>
    <h2>Merci pour votre achat !</h2>
    <p>Votre commande a été validée avec succès.</p>
    <a href="index.php" class="btn-primary">Retour à la boutique</a>
</div>

<style>
    .success-page {
        text-align: center;
        padding: 50px 20px;
    }
    
    .success-icon {
        font-size: 5rem;
        color: #2ecc71;
        margin: 20px 0;
    }
    
    .success-page h2 {
        color: var(--primary);
        margin-bottom: 20px;
    }
    
    .success-page p {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: #555;
    }
</style>

<script>
    toastr.success('Votre paiement a été effectué avec succès', 'Succès', {
        timeOut: 5000,
        positionClass: "toast-bottom-full-width"
    });
</script>

<?php require 'footer.php'; ?>