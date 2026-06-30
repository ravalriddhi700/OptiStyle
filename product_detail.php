<?php
require_once "db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt=$pdo->prepare("SELECT p.*, c.category_name FROM products p LEFT JOIN categories c ON p.category_id=c.category_id WHERE p.product_id=?");
$stmt->execute([$id]);
$product=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$product){ die("Product not found"); }

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(!isset($_SESSION['user_id'])){
        $_SESSION['error']="Please login to add to cart.";
        header("Location: login.php");
        exit;
    }
    $qty=(int)$_POST['qty'];

    // get or create cart
    $st=$pdo->prepare("SELECT * FROM carts WHERE user_id=? AND status='ACTIVE'");
    $st->execute([$_SESSION['user_id']]);
    $cart=$st->fetch(PDO::FETCH_ASSOC);
    if(!$cart){
        $pdo->prepare("INSERT INTO carts(user_id) VALUES(?)")->execute([$_SESSION['user_id']]);
        $cart_id=$pdo->lastInsertId();
    }else $cart_id=$cart['cart_id'];

    // add item
    $st=$pdo->prepare("SELECT * FROM cart_items WHERE cart_id=? AND product_id=?");
    $st->execute([$cart_id,$id]);
    $item=$st->fetch(PDO::FETCH_ASSOC);
    if($item){
        $pdo->prepare("UPDATE cart_items SET quantity=quantity+? WHERE cart_item_id=?")
            ->execute([$qty,$item['cart_item_id']]);
    }else{
        $pdo->prepare("INSERT INTO cart_items(cart_id,product_id,quantity,price) VALUES(?,?,?,?)")
            ->execute([$cart_id,$id,$qty,$product['price']]);
    }
    $_SESSION['success']="Added to cart.";
    header("Location: cart.php");
    exit;
}

include "layout_top.php";
?>

<div class="grid" style="grid-template-columns:1.1fr 1.1fr;gap:22px;">
    <div class="card">
        <div class="product-image" style="height:230px;font-size:32px;">Premium Frame</div>
    </div>
    <div class="card">
        <div class="product-title" style="font-size:18px;"><?php echo htmlspecialchars($product['product_name']); ?></div>
        <div class="product-meta"><?php echo htmlspecialchars($product['category_name']); ?> · <?php echo htmlspecialchars($product['frame_shape']); ?> · <?php echo htmlspecialchars($product['frame_material']); ?></div>
        <div class="product-price" style="font-size:22px;margin-top:8px;">₹<?php echo $product['price']; ?></div>
        <p class="mt-2" style="font-size:13px;"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>

        <form method="post" class="mt-2">
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="qty" value="1" min="1">
            </div>
            <button class="btn btn-primary mt-2">Add to cart</button>
        </form>
    </div>
</div>

<?php include "layout_bottom.php"; ?>
