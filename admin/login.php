<?php
require_once "../db.php";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = $_POST['email']; 
    $pass  = $_POST['password'];

    $st = $pdo->prepare("SELECT * FROM admins WHERE email=?");
    $st->execute([$email]);
    $a = $st->fetch(PDO::FETCH_ASSOC);

    // ---- PLAIN TEXT PASSWORD CHECK ----
    if ($a && $pass === $a['password']) {
        $_SESSION['admin_id'] = $a['admin_id'];
        $_SESSION['admin_name'] = $a['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Invalid admin credentials.";
    }
}
include "../layout_top.php";
?>

<div class="auth-wrapper mt-3">
    <div class="card-solid">
        <h2 class="card-title">Admin Panel</h2>
        <p class="card-sub">Login to manage products, orders & inventory.</p>

        <?php if(!empty($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button class="btn btn-primary mt-2" style="width:100%;">Login</button>
        </form>
    </div>
</div>

<?php include "../layout_bottom.php"; ?>
