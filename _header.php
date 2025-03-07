<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .navbar {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Barre de navigation -->
    <div class="navbar">
        <a href="index.php">Accueil</a>
        <a href="inscription_nageur.php">Devenir Maître-nageur</a>
        <a href="inscription_client.php">Trouver un Maître-nageur</a>
        <a href="contact.php">Contact</a>
    </div>
