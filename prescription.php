<?php
require_once "db.php";
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }

$id=$_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD']==='POST'){
    $rsph = $_POST['right_sph'];
    $lsph = $_POST['left_sph'];
    $pd   = $_POST['pd'];

    $pdo->prepare("INSERT INTO prescriptions(user_id,right_sph,left_sph,pd) VALUES(?,?,?,?)")
        ->execute([$id,$rsph,$lsph,$pd]);

    $_SESSION['success']="Prescription saved!";
}

include "layout_top.php";
?>

<h2 class="section-title">My Prescription</h2>

<div class="auth-wrapper mt-3">
    <div class="card-solid">

        <?php if(!empty($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>Right Eye SPH</label>
                <input type="number" step="0.25" name="right_sph">
            </div>

            <div class="form-group">
                <label>Left Eye SPH</label>
                <input type="number" step="0.25" name="left_sph">
            </div>

            <div class="form-group">
                <label>PD (Pupillary Distance)</label>
                <input type="number" step="0.5" name="pd">
            </div>

            <button class="btn btn-primary mt-2" style="width:100%;">Save</button>
        </form>
    </div>
</div>

<?php include "layout_bottom.php"; ?>
