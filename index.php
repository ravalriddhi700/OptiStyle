<?php
require_once "db.php";
include "layout_top.php";

$cats = $pdo->query("SELECT * FROM categories ORDER BY category_name")->fetchAll(PDO::FETCH_ASSOC);
$latest = $pdo->query("SELECT * FROM products WHERE is_active=1 ORDER BY created_at DESC LIMIT 8")->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero">
    <div class="hero-text">
        <div class="hero-badge">Inspired by Lenskart · Made by You</div>
        <h1 class="hero-title">See better. Look smarter.</h1>
        <p class="hero-sub">Trendy eyeglasses, sunglasses & computer glasses with premium lens options. Cash on Delivery available.</p>
        <div class="hero-cta">
            <a href="products.php" class="btn btn-primary">Browse Collection</a>
        </div>
    </div>
    <div class="hero-image">
        <div class="hero-image-box">
            OptiStyle <span style="font-size:14px;margin-left:6px;">👓</span>
        </div>
    </div>
</section>

<h2 class="section-title">Shop by Category</h2>
<div class="grid">
    <?php foreach($cats as $c): ?>
    <a href="products.php?cat=<?php echo $c['category_id']; ?>">
        <div class="card category-pill">
            <div>
                <div class="category-name"><?php echo htmlspecialchars($c['category_name']); ?></div>
                <div style="font-size:11px;color:#6b7280;">
                    <?php echo htmlspecialchars(substr($c['description'],0,40)); ?>..
                </div>
            </div>
            <div style="font-size:22px;">🕶️</div>
        </div>
    </a>
    <?php endforeach; ?>
</div>

<h2 class="section-title">New Arrivals</h2>
<div class="grid">
    <?php foreach($latest as $p): ?>
    <div class="card">
        <div class="product-image">
            <?php echo htmlspecialchars(substr($p['product_name'],0,1)); ?>-Frame
        </div>
        <div class="product-title"><?php echo htmlspecialchars($p['product_name']); ?></div>
        <div class="product-meta"><?php echo htmlspecialchars($p['frame_shape']); ?> · <?php echo htmlspecialchars($p['frame_material']); ?></div>
        <div class="product-price">₹<?php echo $p['price']; ?></div>
        <div class="product-actions">
            <a href="product_detail.php?id=<?php echo $p['product_id']; ?>" class="btn btn-primary" style="flex:1;">View</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include "layout_bottom.php"; ?>
