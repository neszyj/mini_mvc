<a class="back-btn" href="/">
    ← ACCEUIL
</a>

<!-- catégories -->
<div class="categories">
    <a href="/products">Tous</a>
    <?php foreach ($categories as $cat) : ?>
        <a href="/products/category/<?= $cat['id'] ?>"
           <?php if (!empty($selectedCategory) && $selectedCategory == $cat['id']) echo 'class="active"'; ?>>
           <?= $cat['nom'] ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- produits -->
<div class="catalog">
    <?php foreach ($products as $product) : ?>
        <div class="product-card">
            <img src="/img/<?= $product['image'] ?>" width="150" alt="<?= $product['nom'] ?>">
            <h3><?= $product['nom'] ?></h3>
            <p><?= number_format($product['prix'], 2, ',', ' ') ?> €</p>
            <a href="/products/show/<?= $product['id'] ?>">Voir le produit</a>
            <a href="/cart/add/<?= $product['id'] ?>">Ajouter au panier</a>
        </div>
    <?php endforeach; ?>
</div>



