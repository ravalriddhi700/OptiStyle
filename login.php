<?php
require_once "db.php";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $stmt=$pdo->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->execute([$email]);
    $u=$stmt->fetch(PDO::FETCH_ASSOC);

    if($u && password_verify($pass,$u['password'])){
        $_SESSION['user_id']=$u['user_id'];
        $_SESSION['user_name']=$u['name'];
        header("Location: index.php");
        exit;
    }else{
        $_SESSION['error']="Invalid email or password.";
    }
}
include "layout_top.php";
?>

<div class="auth-wrapper mt-3">
    <div class="card-solid">
        <h2 class="card-title">Welcome back</h2>
        <p class="card-sub">Login to access your saved frames & orders.</p>

        <?php if(!empty($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
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
            <p class="text-center mt-2" style="font-size:12px;">
                New to OptiStyle? <a href="register.php" style="color:var(--primary-dark);">Create account</a>
            </p>
        </form>
    </div>
</div>

<?php include "layout_bottom.php"; ?>
