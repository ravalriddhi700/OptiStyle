<?php
require_once "db.php";
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }

$str=$pdo->prepare("SELECT cart_id FROM carts WHERE user_id=? AND status='ACTIVE'");
$str->execute([$_SESSION['user_id']]);
$cart_id=$str->fetchColumn();

$items=[];
$total=0;
if($cart_id){
    $sql="SELECT ci.*, p.product_name FROM cart_items ci
          JOIN products p ON p.product_id=ci.product_id
          WHERE ci.cart_id=?";
    $st=$pdo->prepare($sql);
    $st->execute([$cart_id]);
    $items=$st->fetchAll(PDO::FETCH_ASSOC);
    foreach($items as $i) $total += $i['price']*$i['quantity'];
}

include "layout_top.php";
?>

<h2 class="section-title">My Cart</h2>

<?php if(isset($_SESSION['success'])): ?>
<div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<?php if(!$items): ?>
    <p style="font-size:13px;">Your cart is empty. <a href="products.php" style="color:var(--primary-dark);">Shop frames</a></p>
<?php else: ?>
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Product</th><th width="80">Qty</th><th width="80">Price</th><th width="80">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($items as $i): ?>
            <tr>
                <td><?php echo htmlspecialchars($i['product_name']); ?></td>
                <td><?php echo $i['quantity']; ?></td>
                <td>₹<?php echo $i['price']; ?></td>
                <td>₹<?php echo $i['price']*$i['quantity']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="text-right mt-2">
        <strong>Total: ₹<?php echo $total; ?></strong>
    </div>
    <div class="text-right mt-2">
        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout (COD)</a>
    </div>
</div>
<?php endif; ?>

<?php include "layout_bottom.php"; ?>
