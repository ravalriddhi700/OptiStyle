<?php
require_once "db.php";
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }

$order_id = (int)$_GET['id'];

$items = $pdo->prepare("
    SELECT oi.*, p.product_name 
    FROM order_items oi
    JOIN products p ON p.product_id = oi.product_id
    WHERE order_id=?
");
$items->execute([$order_id]);
$items = $items->fetchAll(PDO::FETCH_ASSOC);

include "layout_top.php";
?>

<h2 class="section-title">Order #<?= $order_id; ?> Items</h2>

<div class="card">
<table>
    <thead>
        <tr>
            <th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $i): ?>
        <tr>
            <td><?= htmlspecialchars($i['product_name']); ?></td>
            <td><?= $i['quantity']; ?></td>
            <td>₹<?= $i['price']; ?></td>
            <td>₹<?= $i['price'] * $i['quantity']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php include "layout_bottom.php"; ?>
