<?php 
$pageTitle = "Connexion";
require 'header.php'; 
?>

<div class="container">
    <h2>Connectez-vous à votre compte</h2>
    
    <form method="post" class="auth-form">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        
        <button type="submit" class="btn-primary">Se connecter</button>
    </form>
    
    <p class="auth-link">Nouveau chez BANTOU ? <a href="register.php">Créez un compte</a></p>
</div>

<?php require 'footer.php'; ?>