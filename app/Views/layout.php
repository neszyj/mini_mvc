<!doctype html>
<!-- Définit la langue du document -->
<html lang="fr">
<!-- En-tête du document HTML -->
<head>
    <!-- Déclare l'encodage des caractères -->
    <meta charset="utf-8">
    <!-- Configure le viewport pour les appareils mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Définit le titre de la page avec échappement -->
    <title><?= isset($title) ? htmlspecialchars($title) : 'NESZPARFUM' ?></title>

    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<!-- Corps du document -->
<body>
    <!-- En-tête de la page -->
    <header>
        <!-- Affiche le titre -->
        <h1><?= isset($title) ? htmlspecialchars($title) : 'NESZPARFUM' ?></h1>

        <!-- Logo panier et connexion/inscription -->
        <div class="header-icons">
            <!-- Lien vers le panier -->
            <a href="/panier" title="Voir le panier">
                <img src="/img/panier.png" alt="Panier" width="30">
            </a>

            <!-- Lien vers la connexion/inscription -->
            <a href="/login" title="Se connecter / S'inscrire">
                <img src="/img/user.png" alt="Utilisateur" width="30">
            </a>
        </div>
    </header>

    <!-- Zone de contenu principal -->
    <main>
        <!-- Insère le contenu rendu de la vue -->
        <?= $content ?>
    </main>

    <!-- Fin du corps de la page -->
</body>
<!-- Fin du document HTML -->
</html>
