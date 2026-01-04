<h1>PANIER</h1>

<?php if (empty($cartItems)) : ?>

    <p>Votre panier est vide</p>

    <a class="back-btn" href="/products">
        ← CATALOGUE
    </a>

    <a class="back-btn right" href="/">
        ← ACCEUIL
    </a>


<?php else : ?>


    <div class="cart-container">

        <?php foreach ($cartItems as $item) : ?>
            <div class="cart-item">

                <div class="cart-left">
                    <img src="/img/<?= $item['image'] ?>" alt="<?= $item['nom'] ?>">

                    <div>
                        <h3><?= $item['nom'] ?></h3>

                        <p><?= $item['description'] ?? '' ?></p>

                        <p class="price">
                            <?= number_format($item['prix'], 2, ',', ' ') ?> €
                        </p>

                        <p>
                            Quantité : 
                            <form action="/cart/update/<?= $item['cart_id'] ?>" method="post">
                                <input type="number" name="quantite" value="<?= $item['quantite'] ?>" min="1">
                                <button type="submit">Mettre à jour</button>
                            </form>
                        </p>

                    </div>
                </div>

                <a class="remove-btn" href="/cart/remove/<?= $item['cart_id'] ?>">
                    Supprimer
                </a>

            </div>
        <?php endforeach; ?>

    </div>

    <div class="cart-total">
        Total:
        <strong><?= number_format($total, 2, ',', ' ') ?> €</strong>
    </div>

    <a class="clear-btn" href="/cart/clear">
        VIDER LE PANIER
    </a>

        <a class="back-btn" href="/products">
    ← CATALOGUE
    </a>

<?php endif; ?>