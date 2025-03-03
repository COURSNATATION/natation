<?php
// Démarrer la session (pas nécessaire ici, mais inclus pour cohérence)
session_start();

// Activer les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base MySQL locale (MAMP)
try {
    $db = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_log("Connexion MySQL réussie dans coordonnees_nageurs.php");
} catch (PDOException $e) {
    error_log("Erreur de connexion MySQL : " . $e->getMessage());
    die("Erreur de connexion à la base MySQL : " . $e->getMessage());
}

// Récupérer les IDs des nageurs depuis PayPal (via $_GET['custom'])
$nageurIds = isset($_GET['custom']) ? explode(',', $_GET['custom']) : [];
if (empty($nageurIds)) {
    die("Aucun nageur sélectionné ou paiement non validé.");
}

// Récupérer les détails des nageurs
$nageurs = [];
try {
    $placeholders = implode(',', array_fill(0, count($nageurIds), '?'));
    $stmt = $db->prepare("SELECT nom, prenom, tel, email, diplome, photo, ville, dispo, preference 
                          FROM nageur WHERE id IN ($placeholders)");
    $stmt->execute($nageurIds);
    $nageurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log("Nageurs récupérés : " . count($nageurs));
} catch (PDOException $e) {
    error_log("Erreur récupération nageurs : " . $e->getMessage());
    die("Erreur lors de la récupération des nageurs : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordonnées des Maîtres-Nageurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #47c3e6;
        }
        .nageur {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        img {
            max-width: 200px;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Coordonnées des Maîtres-Nageurs</h2>
        <?php if (!empty($nageurs)) : ?>
            <?php foreach ($nageurs as $nageur) : ?>
                <div class="nageur">
                    <p><strong>Nom :</strong> <?php echo htmlspecialchars($nageur['nom']); ?></p>
                    <p><strong>Prénom :</strong> <?php echo htmlspecialchars($nageur['prenom']); ?></p>
                    <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($nageur['tel']); ?></p>
                    <p><strong>Email :</strong> <?php echo htmlspecialchars($nageur['email']); ?></p>
                    <p><strong>Diplôme :</strong> <?php echo htmlspecialchars($nageur['diplome']); ?></p>
                    <p><strong>Ville :</strong> <?php echo htmlspecialchars($nageur['ville']); ?></p>
                    <p><strong>Disponibilités :</strong> <?php echo htmlspecialchars($nageur['dispo']); ?></p>
                    <p><strong>Préférence :</strong> <?php echo htmlspecialchars($nageur['preference']); ?></p>
                    <?php if (!empty($nageur['photo'])) : ?>
                        <img src="<?php echo htmlspecialchars($nageur['photo']); ?>" alt="Photo de <?php echo htmlspecialchars($nageur['prenom']); ?>">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Aucun maître-nageur disponible pour afficher les coordonnées.</p>
        <?php endif; ?>
    </div>
</body>
</html>