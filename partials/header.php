<?php require_once __DIR__ . "/../config.php"; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>OptiStyle - Premium Eyewear</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/optistyle/assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/optistyle/index.php">
      <i class="fa-solid fa-glasses"></i> OPTISTYLE
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="/optistyle/index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/optistyle/user/products.php">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="/optistyle/user/about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/optistyle/user/contact.php">Contact</a></li>
        <?php if(isUserLoggedIn()): ?>
          <li class="nav-item"><a class="nav-link" href="/optistyle/user/orders.php">My Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="/optistyle/user/cart.php">
            <i class="fa fa-shopping-cart"></i> Cart
          </a></li>
          <li class="nav-item"><a class="btn btn-outline-light ms-lg-3" href="/optistyle/user/logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="btn btn-primary ms-lg-3" href="/optistyle/user/login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="page-wrapper">
