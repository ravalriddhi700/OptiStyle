<?php
require_once "db.php";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $phone = $_POST['phone'];
    $city  = $_POST['city'];
    $state = $_POST['state'];
    $pin   = $_POST['pincode'];

    $sql = "INSERT INTO users(name,email,password,phone,city,state,pincode)
            VALUES(?,?,?,?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    try{
        $stmt->execute([$name,$email,$pass,$phone,$city,$state,$pin]);
        $_SESSION['success']="Account created. Please login.";
        header("Location: login.php");
        exit;
    }catch(PDOException $e){
        $_SESSION['error']="Email already registered.";
    }
}

include "layout_top.php";
?>

<div class="auth-wrapper mt-3">
    <div class="card-solid">
        <h2 class="card-title">Create your OptiStyle account</h2>
        <p class="card-sub">Save prescriptions, track orders & manage your eyewear easily.</p>

        <?php if(!empty($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password*</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone">
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city">
            </div>
            <div class="form-group">
                <label>State</label>
                <input type="text" name="state">
            </div>
            <div class="form-group">
                <label>Pincode</label>
                <input type="text" name="pincode">
            </div>
            <button class="btn btn-primary mt-2" style="width:100%;">Sign up</button>
            <p class="text-center mt-2" style="font-size:12px;">
                Already a member? <a href="login.php" style="color:var(--primary-dark);">Login</a>
            </p>
        </form>
    </div>
</div>

<?php include "layout_bottom.php"; ?>
