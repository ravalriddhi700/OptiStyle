<?php
require_once "../db.php";
if(!isset($_SESSION['admin_id'])){ header("Location: login.php"); exit; }

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['add'])){
        $name=$_POST['category_name'];
        $desc=$_POST['description'];
        $pdo->prepare("INSERT INTO categories(category_name,description) VALUES(?,?)")
            ->execute([$name,$desc]);
    }
    if(isset($_POST['delete'])){
        $id=(int)$_POST['id'];
        $pdo->prepare("DELETE FROM categories WHERE category_id=?")->execute([$id]);
    }
}
$cats=$pdo->query("SELECT * FROM categories ORDER BY category_id DESC")->fetchAll(PDO::FETCH_ASSOC);

include "../layout_top.php";
?>

<h2 class="section-title">Manage Categories</h2>

<div class="card">
    <form method="post" style="display:flex;gap:8px;flex-wrap:wrap;">
        <div style="flex:1 1 180px;">
            <label style="font-size:12px;">Category name</label>
            <input type="text" name="category_name" required>
        </div>
        <div style="flex:2 1 250px;">
            <label style="font-size:12px;">Description</label>
            <input type="text" name="description">
        </div>
        <div style="align-self:flex-end;">
            <button class="btn btn-primary" name="add">Add</button>
        </div>
    </form>
</div>

<div class="card mt-2">
    <table>
        <thead>
            <tr><th>ID</th><th>Name</th><th>Description</th><th width="80">Action</th></tr>
        </thead>
        <tbody>
            <?php foreach($cats as $c): ?>
            <tr>
                <td><?php echo $c['category_id']; ?></td>
                <td><?php echo htmlspecialchars($c['category_name']); ?></td>
                <td><?php echo htmlspecialchars($c['description']); ?></td>
                <td>
                    <form method="post" onsubmit="return confirm('Delete category?');">
                        <input type="hidden" name="id" value="<?php echo $c['category_id']; ?>">
                        <button class="btn" name="delete" style="padding:4px 10px;background:#fee2e2;color:#b91c1c;">×</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../layout_bottom.php"; ?>
