<?php
require_once "../db.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$categories = $pdo->query("SELECT * FROM categories ORDER BY category_name")->fetchAll(PDO::FETCH_ASSOC);

/* ADD PRODUCT */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = $_POST['product_name'];
    $cat  = $_POST['category_id'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $shape = $_POST['frame_shape'];
    $mat   = $_POST['frame_material'];
    $image = $_POST['image']; // storing filename only (upload optional)

    $sql = "INSERT INTO products (category_id, product_name, description, price, frame_shape, frame_material, image)
            VALUES (?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cat, $name, $desc, $price, $shape, $mat, $image]);
}

/* DELETE PRODUCT */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $pdo->prepare("DELETE FROM products WHERE product_id=?")->execute([$id]);
}

/* FETCH PRODUCTS */
$products = $pdo->query("
    SELECT p.*, c.category_name 
    FROM products p 
    LEFT JOIN categories c ON p.category_id=c.category_id 
    ORDER BY p.product_id DESC
")->fetchAll(PDO::FETCH_ASSOC);

include "../layout_top.php";
?>

<h2 class="section-title">Manage Products</h2>

<!-- ADD FORM -->
<div class="card">
    <form method="post" style="display:flex; flex-wrap:wrap; gap:12px;">
        
        <div style="flex:1 1 200px;">
            <label>Product Name</label>
            <input type="text" name="product_name" required>
        </div>

        <div style="flex:1 1 150px;">
            <label>Category</label>
            <select name="category_id" required>
                <?php foreach ($categories as $c): ?>
                <option value="<?= $c['category_id']; ?>"><?= htmlspecialchars($c['category_name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="flex:1 1 120px;">
            <label>Price (₹)</label>
            <input type="number" name="price" required>
        </div>

        <div style="flex:1 1 150px;">
            <label>Frame Shape</label>
            <input type="text" name="frame_shape">
        </div>

        <div style="flex:1 1 150px;">
            <label>Frame Material</label>
            <input type="text" name="frame_material">
        </div>

        <div style="flex:1 1 200px;">
            <label>Image Filename</label>
            <input type="text" name="image" placeholder="example.png">
        </div>

        <div style="flex:1 1 100%;">
            <label>Description</label>
            <textarea name="description"></textarea>
        </div>

        <button class="btn btn-primary" name="add" style="margin-top:10px;">Add Product</button>
    </form>
</div>

<!-- PRODUCT LIST -->
<div class="card mt-3">
<table>
    <thead>
        <tr>
            <th>ID</th><th>Product</th><th>Category</th><th>Price</th>
            <th>Shape</th><th>Material</th><th>Image</th><th width="70">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['product_id']; ?></td>
            <td><?= htmlspecialchars($p['product_name']); ?></td>
            <td><?= htmlspecialchars($p['category_name']); ?></td>
            <td>₹<?= $p['price']; ?></td>
            <td><?= htmlspecialchars($p['frame_shape']); ?></td>
            <td><?= htmlspecialchars($p['frame_material']); ?></td>
            <td><?= htmlspecialchars($p['image']); ?></td>
            <td>
                <form method="post" onsubmit="return confirm('Delete product?');">
                    <input type="hidden" name="id" value="<?= $p['product_id']; ?>">
                    <button class="btn" name="delete"
                        style="padding:4px 10px;background:#fee2e2;color:#b91c1c;">×</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php include "../layout_bottom.php"; ?>
