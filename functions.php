<?php
// functions.php
require_once "config.php";

function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function getCategories(){
    global $pdo;
    return $pdo->query("SELECT * FROM categories WHERE 1 ORDER BY category_name")->fetchAll(PDO::FETCH_ASSOC);
}
?>
