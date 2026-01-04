<h1><?= $product['nom'] ?></h1>

<img src="/img/<?= $product['image'] ?>" width="200" alt="<?= $product['nom'] ?>">

<p><?= $product['description'] ?></p>
<p><strong><?= number_format($product['prix'], 2, ',', ' ') ?> €</strong></p>

<a href="/cart/add/<?= $product['id'] ?>">Ajouter au panier</a>
<a href="/products">Retour au catalogue</a>
