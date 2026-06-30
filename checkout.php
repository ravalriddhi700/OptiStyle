<?php
require_once "db.php";
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }

$user_id=$_SESSION['user_id'];

$st=$pdo->prepare("SELECT cart_id FROM carts WHERE user_id=? AND status='ACTIVE'");
$st->execute([$user_id]);
$cart_id=$st->fetchColumn();
if(!$cart_id){ header("Location: cart.php"); exit; }

$u=$pdo->prepare("SELECT * FROM users WHERE user_id=?");
$u->execute([$user_id]);
$user=$u->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']==='POST'){
    // load items
    $sql="SELECT * FROM cart_items WHERE cart_id=?";
    $st=$pdo->prepare($sql);
    $st->execute([$cart_id]);
    $items=$st->fetchAll(PDO::FETCH_ASSOC);

    $total=0;
    foreach($items as $i) $total += $i['price']*$i['quantity'];

    // create order
    $o=$pdo->prepare("INSERT INTO orders(user_id,total_amount,ship_name,ship_phone,ship_city,ship_state,ship_pincode)
                      VALUES(?,?,?,?,?,?,?)");
    $o->execute([
        $user_id,$total,
        $user['name'],$user['phone'],$user['city'],$user['state'],$user['pincode']
    ]);
    $order_id=$pdo->lastInsertId();

    // order items + inventory
    $oi=$pdo->prepare("INSERT INTO order_items(order_id,product_id,quantity,price) VALUES(?,?,?,?)");
    $inv=$pdo->prepare("UPDATE inventory SET quantity = quantity - ? WHERE product_id=?");
    foreach($items as $i){
        $oi->execute([$order_id,$i['product_id'],$i['quantity'],$i['price']]);
        $inv->execute([$i['quantity'],$i['product_id']]);
    }

    // close cart
    $pdo->prepare("UPDATE carts SET status='INACTIVE' WHERE cart_id=?")->execute([$cart_id]);
    // shipments
    $pdo->prepare("INSERT INTO shipments(order_id) VALUES(?)")->execute([$order_id]);

    $_SESSION['success']="Order placed successfully. Pay cash on delivery.";
    header("Location: orders.php");
    exit;
}

include "layout_top.php";
?>

<div class="auth-wrapper mt-3">
    <div class="card-solid">
        <h2 class="card-title">Confirm your order</h2>
        <p class="card-sub">Payment method: Cash on Delivery (COD)</p>

        <p style="font-size:13px;"><strong>Deliver to:</strong><br>
            <?php echo htmlspecialchars($user['name']); ?><br>
            <?php echo htmlspecialchars($user['city']); ?>, <?php echo htmlspecialchars($user['state']); ?> - <?php echo htmlspecialchars($user['pincode']); ?><br>
            Phone: <?php echo htmlspecialchars($user['phone']); ?>
        </p>

        <form method="post">
            <button class="btn btn-primary" style="width:100%;margin-top:10px;">Place Order</button>
        </form>
    </div>
</div>

<?php include "layout_bottom.php"; ?>
