<?php
require_once "db.php";
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$orders = $pdo->prepare("
    SELECT * FROM orders 
    WHERE user_id=? 
    ORDER BY order_id DESC
");
$orders->execute([$user_id]);
$orders = $orders->fetchAll(PDO::FETCH_ASSOC);

include "layout_top.php";
?>

<h2 class="section-title">My Orders</h2>

<?php if(empty($orders)): ?>
    <div class="card">
        <p style="font-size:13px;">You have not placed any orders yet.</p>
        <a href="products.php" class="btn btn-primary mt-2" style="width:150px;">Shop Now</a>
    </div>
<?php else: ?>

<?php foreach($orders as $o): ?>

<div class="card" style="margin-bottom:14px;">
    <div style="font-size:14px;"><strong>Order #<?= $o['order_id']; ?></strong></div>
    <div style="font-size:12px;color:#6b7280;margin-top:2px;">
        <?= $o['placed_at']; ?> • Cash on Delivery
    </div>

    <div style="margin-top:8px;">
        <strong>Total:</strong> ₹<?= $o['total_amount']; ?>
    </div>

    <div style="margin-top:4px;">
        <strong>Status:</strong>
        <span class="badge 
            <?php if($o['status']=='PENDING') echo 'badge-pending';
                  if($o['status']=='SHIPPED') echo 'badge-shipped';
                  if($o['status']=='DELIVERED') echo 'badge-delivered';
                  if($o['status']=='CANCELLED') echo 'badge-cancelled';
            ?>">
            <?= $o['status']; ?>
        </span>
    </div>

    <a href="order_items.php?id=<?= $o['order_id']; ?>" class="btn btn-primary" style="margin-top:10px;width:120px;">
        View Items
    </a>
</div>

<?php endforeach; ?>

<?php endif; ?>

<?php include "layout_bottom.php"; ?>
