<?php
require_once "db.php";
include "layout_top.php";

$cat_id = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;

if($cat_id){
    $stmt=$pdo->prepare("SELECT * FROM products WHERE is_active=1 AND category_id=?");
    $stmt->execute([$cat_id]);
} else {
    $stmt=$pdo->query("SELECT * FROM products WHERE is_active=1");
}
$products=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="section-title">All Eyewear</h2>
<div class="grid">
    <?php foreach($products as $p): ?>
    <div class="card">
        <div class="product-image"><?php echo htmlspecialchars(substr($p['product_name'],0,1)); ?>-Frame</div>
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
