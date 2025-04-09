<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BANTOU - <?= $pageTitle ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #e74c3c;
            --light: #ecf0f1;
            --dark: #1a252f;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        header {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/bantou-banner.jpg');
            background-size: cover;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
        }
        
        .logo {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 5px;
        }
        
        .tagline {
            font-size: 1.2rem;
            font-style: italic;
        }
        
        nav {
            background-color: var(--primary);
            padding: 12px;
            display: inline;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s;
            right: 240px;
        }
        
        
        
        nav a {
            color: white;
            text-decoration: none;
            
            bottom: 1200px;    
        }
        
        nav a:hover {
            background-color: var(--secondary);
        }
        
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        footer {
            background-color: var(--dark);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">BANTOU</div>
        <div class="tagline">L'artisanat africain à votre portée</div>
    </header>
    
    <nav>
        
            
            <a href="login.php">Déconnexion</a>

        
    </nav>