<?php
require_once "../db.php";
if(!isset($_SESSION['admin_id'])){ header("Location: login.php"); exit; }

$users   = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$products= $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$orders  = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$revenue = $pdo->query("SELECT IFNULL(SUM(total_amount),0) FROM orders")->fetchColumn();

include "../layout_top.php";
?>

<h2 class="section-title">Admin Dashboard</h2>

<div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr));">
    <div class="card">
        <div class="category-name">Users</div>
        <div style="font-size:24px;font-weight:700;margin-top:6px;"><?php echo $users; ?></div>
    </div>
    <div class="card">
        <div class="category-name">Products</div>
        <div style="font-size:24px;font-weight:700;margin-top:6px;"><?php echo $products; ?></div>
    </div>
    <div class="card">
        <div class="category-name">Orders</div>
        <div style="font-size:24px;font-weight:700;margin-top:6px;"><?php echo $orders; ?></div>
    </div>
    <div class="card">
        <div class="category-name">Total COD Amount</div>
        <div style="font-size:24px;font-weight:700;margin-top:6px;">₹<?php echo $revenue; ?></div>
    </div>
</div>

<div class="mt-3">
    <a href="categories.php" class="btn btn-primary">Manage Categories</a>
    <a href="products.php" class="btn btn-primary">Manage Products</a>
    <a href="orders.php" class="btn btn-primary">Manage Orders</a>
</div>

<?php include "../layout_bottom.php"; ?>
