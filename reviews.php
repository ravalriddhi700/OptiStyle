<?php
require_once "db.php";
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = (int)$_GET['product_id'];

if($_SERVER['REQUEST_METHOD']==='POST'){
    $rate = $_POST['rating'];
    $com  = $_POST['comment'];

    $pdo->prepare("INSERT INTO reviews(user_id,product_id,rating,comment)
                   VALUES(?,?,?,?)")
        ->execute([$user_id,$product_id,$rate,$com]);

    $_SESSION['success']="Review posted!";
}

include "layout_top.php";
?>

<h2 class="section-title">Write a Review</h2>

<div class="auth-wrapper mt-3">
    <div class="card-solid">

        <?php if(!empty($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>Rating (1-5)</label>
                <input type="number" min="1" max="5" name="rating" required>
            </div>

            <div class="form-group">
                <label>Your Review</label>
                <textarea name="comment"></textarea>
            </div>

            <button class="btn btn-primary mt-2" style="width:100%;">Submit</button>
        </form>
    </div>
</div>

<?php include "layout_bottom.php"; ?>
