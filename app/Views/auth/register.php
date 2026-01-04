<!-- inscription -->

<?php if (!empty($error)) : ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/register">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Créer mon compte</button>
</form>

<p>
    Déjà inscrit ?
    <a href="/login">Se connecter</a>
</p>

<p>
    <a class="back-btn right" href="/">
        ← Accueil
    </a>
</p>
