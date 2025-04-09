<?php
$pageTitle = "Connexion";
require 'header.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $db->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    // Requête préparée pour plus de sécurité
    $stmt = $db->prepare("SELECT id, name, phone, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            // Création de la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];      // Pour MoneyFusion
            $_SESSION['user_phone'] = $user['phone'];    // Pour MoneyFusion
            
            // Message de bienvenue et redirection
            $_SESSION['welcome_message'] = "Bienvenue, " . htmlspecialchars($user['name']) . " !";
            header('Location: index.php');
            exit;
        }
    }
    
    // Si échec
    $error = "Identifiants incorrects";
}
?>

<div class="container">
    <h2>Connectez-vous à votre compte</h2>
    
    <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="post" class="auth-form">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required class="form-control">
        </div>
        
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" required class="form-control">
        </div>
        
        <button type="submit" class="btn-primary">Se connecter</button>
    </form>
    
    <p class="auth-link">Nouveau chez BANTOU ? <a href="register.php">Créez un compte</a></p>
</div>

<?php require 'footer.php'; ?>