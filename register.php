<?php 
$pageTitle = "Inscription";
require 'header.php'; 
?>

<div class="container">
    <h2>Devenez membre BANTOU</h2>
    
    <form method="post" class="auth-form">
        <div class="form-group">
            <label>Nom complet</label>
            <input type="text" name="name" required>
        </div>
        
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label>Téléphone</label>
            <input type="tel" name="phone" required>
        </div>
        
        <button type="submit" class="btn-primary">S'inscrire</button>
    </form>
    
    <p class="auth-link">Déjà membre ? <a href="login.php">Connectez-vous</a></p>
</div>

<style>
    .auth-form {
        max-width: 500px;
        margin: 30px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }
    
    .btn-primary {
        background-color: var(--secondary);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s;
    }
    
    .btn-primary:hover {
        background-color: #c0392b;
    }
    
    .auth-link {
        text-align: center;
        margin-top: 20px;
    }
</style>

<?php require 'footer.php'; ?>