<?php
require_once "../db.php";
if(!isset($_SESSION['admin_id'])){ header("Location: login.php"); exit; }

$ships=$pdo->query("
SELECT s.*, o.total_amount, u.name 
FROM shipments s
JOIN orders o ON o.order_id=s.order_id
JOIN users u ON u.user_id=o.user_id
ORDER BY s.shipment_id DESC
")->fetchAll(PDO::FETCH_ASSOC);

include "../layout_top.php";
?>

<h2 class="section-title">Shipments</h2>

<div class="card">
<table>
<thead>
<tr><th>ID</th><th>Order</th><th>User</th><th>Status</th><th>Assigned</th></tr>
</thead>
<tbody>
<?php foreach($ships as $s): ?>
<tr>
    <td><?= $s['shipment_id']; ?></td>
    <td>#<?= $s['order_id']; ?> · ₹<?= $s['total_amount']; ?></td>
    <td><?= htmlspecialchars($s['name']); ?></td>
    <td><?= $s['status']; ?></td>
    <td><?= $s['assigned_at']; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<?php include "../layout_bottom.php"; ?>
