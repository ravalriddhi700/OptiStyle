<?php
require_once "../db.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* UPDATE INVENTORY */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = $_POST['product_id'];
    $qty = $_POST['quantity'];

    $st = $pdo->prepare("SELECT * FROM inventory WHERE product_id=?");
    $st->execute([$pid]);
    $exist = $st->fetch(PDO::FETCH_ASSOC);

    if ($exist) {
        $pdo->prepare("UPDATE inventory SET quantity=? WHERE product_id=?")
            ->execute([$qty, $pid]);
    } else {
        $pdo->prepare("INSERT INTO inventory(product_id,quantity) VALUES(?,?)")
            ->execute([$pid, $qty]);
    }
}

$inv = $pdo->query("
SELECT p.product_id, p.product_name, IFNULL(i.quantity,0) AS qty
FROM products p
LEFT JOIN inventory i ON p.product_id=i.product_id
ORDER BY p.product_id DESC
")->fetchAll(PDO::FETCH_ASSOC);

include "../layout_top.php";
?>

<h2 class="section-title">Manage Inventory</h2>

<div class="card">
<table>
<thead>
<tr><th>ID</th><th>Product</th><th>Quantity</th><th width="150">Update</th></tr>
</thead>
<tbody>
<?php foreach ($inv as $p): ?>
<tr>
    <td><?= $p['product_id']; ?></td>
    <td><?= htmlspecialchars($p['product_name']); ?></td>
    <td><?= $p['qty']; ?></td>
    <td>
        <form method="post" style="display:flex;gap:6px;">
            <input type="hidden" name="product_id" value="<?= $p['product_id']; ?>">
            <input type="number" name="quantity" value="<?= $p['qty']; ?>" style="width:60px;">
            <button class="btn btn-primary">Save</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<?php include "../layout_bottom.php"; ?>
