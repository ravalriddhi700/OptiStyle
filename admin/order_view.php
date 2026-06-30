<?php
require_once "../db.php";
if(!isset($_SESSION['admin_id'])){ header("Location: login.php"); exit; }

$id=(int)$_GET['id'];

$order = $pdo->prepare("SELECT o.*, u.name FROM orders o JOIN users u ON o.user_id=u.user_id WHERE order_id=?");
$order->execute([$id]);
$ord=$order->fetch(PDO::FETCH_ASSOC);

if(!$ord) die("Order not found.");

$items=$pdo->prepare("
SELECT oi.*, p.product_name 
FROM order_items oi
JOIN products p ON p.product_id=oi.product_id
WHERE oi.order_id=?
");
$items->execute([$id]);

$ship=$pdo->prepare("SELECT * FROM shipments WHERE order_id=?");
$ship->execute([$id]);
$shipment=$ship->fetch(PDO::FETCH_ASSOC);

/* UPDATE ORDER STATUS */
if($_SERVER['REQUEST_METHOD']==='POST'){
    $status=$_POST['status'];
    $pdo->prepare("UPDATE orders SET status=? WHERE order_id=?")->execute([$status,$id]);
    $_SESSION['success']="Status updated.";
    header("Location: order_view.php?id=".$id);
    exit;
}

include "../layout_top.php";
?>

<h2 class="section-title">Order #<?= $id; ?> Details</h2>

<div class="card">
    <p><strong>User:</strong> <?= htmlspecialchars($ord['name']); ?></p>
    <p><strong>Total:</strong> ₹<?= $ord['total_amount']; ?></p>
    <p><strong>Status:</strong> <?= $ord['status']; ?></p>
    <p><strong>Date:</strong> <?= $ord['placed_at']; ?></p>

    <form method="post" class="mt-2">
        <label>Update Status</label>
        <select name="status">
            <option <?= $ord['status']=='PENDING'?'selected':'' ?>>PENDING</option>
            <option <?= $ord['status']=='SHIPPED'?'selected':'' ?>>SHIPPED</option>
            <option <?= $ord['status']=='DELIVERED'?'selected':'' ?>>DELIVERED</option>
            <option <?= $ord['status']=='CANCELLED'?'selected':'' ?>>CANCELLED</option>
        </select>
        <button class="btn btn-primary mt-2">Save</button>
    </form>
</div>

<h3 class="section-title">Items</h3>
<div class="card">
<table>
    <thead>
        <tr><th>Product</th><th>Qty</th><th>Price</th></tr>
    </thead>
    <tbody>
    <?php foreach($items as $i): ?>
        <tr>
            <td><?= htmlspecialchars($i['product_name']); ?></td>
            <td><?= $i['quantity']; ?></td>
            <td>₹<?= $i['price']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php include "../layout_bottom.php"; ?>
