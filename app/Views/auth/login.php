<!-- connexion -->

<?php if (!empty($error)) : ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/login">
    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Connexion</button>
</form>

<p>
    Pas de compte ?
    <a href="/register">Créer un compte</a>
</p>

<p>
    <a class="back-btn right" href="/">
        ← Accueil
    </a>
</p>
