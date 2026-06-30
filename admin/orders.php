<?php
require_once "../db.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$orders = $pdo->query("
SELECT o.*, u.name 
FROM orders o
LEFT JOIN users u ON o.user_id=u.user_id
ORDER BY o.order_id DESC
")->fetchAll(PDO::FETCH_ASSOC);

include "../layout_top.php";
?>

<h2 class="section-title">Manage Orders</h2>

<div class="card">
<table>
<thead>
<tr>
    <th>ID</th><th>User</th><th>Amount</th>
    <th>Status</th><th>Date</th><th width="80">Details</th>
</tr>
</thead>
<tbody>

<?php foreach($orders as $o): ?>
<tr>
    <td><?= $o['order_id']; ?></td>
    <td><?= htmlspecialchars($o['name']); ?></td>
    <td>₹<?= $o['total_amount']; ?></td>
    <td>
        <span class="badge 
            <?php if($o['status']=='PENDING') echo 'badge-pending';
                  elseif($o['status']=='SHIPPED') echo 'badge-shipped';
                  elseif($o['status']=='DELIVERED') echo 'badge-delivered';
                  else echo 'badge-cancelled';
            ?>">
            <?= $o['status']; ?>
        </span>
    </td>
    <td><?= $o['placed_at']; ?></td>
    <td>
        <a href="order_view.php?id=<?= $o['order_id']; ?>" class="btn btn-primary" style="padding:4px 8px;">View</a>
    </td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
</div>

<?php include "../layout_bottom.php"; ?>
