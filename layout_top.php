<?php
require_once "db.php";

function isUserLoggedIn(){
    return isset($_SESSION['user_id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OPTISTYLE - Online Eyewear Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- INTERNAL CSS ONLY -->
    <style>
        :root{
            --primary:#00b894;
            --primary-dark:#00916e;
            --bg:#f5f7fb;
            --text:#1f2933;
        }
        *{box-sizing:border-box;margin:0;padding:0;}
        body{
            font-family: system-ui,-apple-system,"Segoe UI",sans-serif;
            background:var(--bg);
            color:var(--text);
        }
        a{text-decoration:none;color:inherit;}
        .container{
            width:100%;
            max-width:1200px;
            margin:0 auto;
            padding:0 15px;
        }
        /* NAVBAR */
        .navbar{
            background:linear-gradient(90deg,#0b172a,#102a43);
            color:#fff;
            position:sticky;
            top:0;
            z-index:999;
        }
        .navbar-inner{
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:10px 15px;
        }
        .brand{
            display:flex;
            align-items:center;
            font-weight:700;
            letter-spacing:1px;
        }
        .brand-icon{
            width:28px;
            height:28px;
            border-radius:50%;
            background:var(--primary);
            display:flex;
            align-items:center;
            justify-content:center;
            margin-right:8px;
            font-size:18px;
        }
        .nav-links{
            display:flex;
            gap:18px;
            font-size:14px;
        }
        .nav-links a{
            padding:6px 10px;
            border-radius:999px;
            transition:0.2s;
        }
        .nav-links a:hover{
            background:rgba(255,255,255,0.1);
        }
        .btn{
            display:inline-block;
            padding:8px 16px;
            border-radius:999px;
            border:none;
            cursor:pointer;
            font-size:14px;
            font-weight:600;
        }
        .btn-primary{
            background:var(--primary);
            color:#fff;
        }
        .btn-primary:hover{background:var(--primary-dark);}
        .btn-outline{
            background:transparent;
            color:#fff;
            border:1px solid rgba(255,255,255,0.35);
        }
        main{padding:20px 0 40px;}

        /* HERO */
        .hero{
            background:linear-gradient(135deg,#0b172a,#1e3a8a);
            color:#fff;
            border-radius:24px;
            padding:30px 24px;
            display:flex;
            flex-wrap:wrap;
            gap:20px;
            align-items:center;
            margin-top:15px;
        }
        .hero-text{flex:1 1 260px;}
        .hero-title{font-size:32px;font-weight:700;margin-bottom:10px;}
        .hero-sub{font-size:14px;opacity:0.85;margin-bottom:16px;}
        .hero-badge{
            display:inline-block;
            padding:4px 10px;
            font-size:11px;
            border-radius:999px;
            background:rgba(255,255,255,0.1);
            margin-bottom:10px;
        }
        .hero-cta{margin-top:8px;}
        .hero-image{
            flex:1 1 260px;
            text-align:center;
        }
        .hero-image-box{
            width:230px;
            height:160px;
            margin:0 auto;
            background:#e5f7f4;
            border-radius:24px;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#0b172a;
            font-weight:600;
            font-size:22px;
        }

        /* GRID & CARDS */
        .section-title{
            font-size:18px;
            font-weight:600;
            margin:24px 0 12px;
        }
        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
            gap:16px;
        }
        .card{
            background:#fff;
            border-radius:18px;
            padding:14px;
            box-shadow:0 8px 22px rgba(15,23,42,0.08);
            transition:transform .2s,box-shadow .2s;
        }
        .card:hover{
            transform:translateY(-4px);
            box-shadow:0 16px 35px rgba(15,23,42,0.12);
        }
        .category-pill{
            height:54px;
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .category-name{
            font-size:14px;
            font-weight:600;
        }

        .product-image{
            width:100%;
            height:170px;
            border-radius:14px;
            background:#e5f7f4;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:26px;
            margin-bottom:10px;
        }
        .product-title{font-size:14px;font-weight:600;margin-bottom:4px;}
        .product-meta{font-size:11px;color:#6b7280;margin-bottom:6px;}
        .product-price{font-weight:700;color:#111827;font-size:15px;}
        .product-actions{margin-top:8px;display:flex;gap:6px;}

        /* FORMS */
        .auth-wrapper{
            max-width:420px;
            margin:0 auto;
        }
        .card-solid{
            background:#fff;
            border-radius:20px;
            padding:22px 20px;
            box-shadow:0 10px 26px rgba(15,23,42,0.1);
        }
        .card-title{
            font-size:18px;
            font-weight:600;
            margin-bottom:4px;
            text-align:center;
        }
        .card-sub{
            font-size:12px;
            text-align:center;
            color:#6b7280;
            margin-bottom:14px;
        }
        .form-group{margin-bottom:10px;font-size:13px;}
        label{display:block;margin-bottom:4px;}
        input,select,textarea{
            width:100%;
            padding:8px 10px;
            border-radius:10px;
            border:1px solid #d1d5db;
            font-size:13px;
        }
        input:focus,select:focus,textarea:focus{
            outline:none;
            border-color:var(--primary);
            box-shadow:0 0 0 1px rgba(0,184,148,0.3);
        }
        .text-center{text-align:center;}
        .text-right{text-align:right;}
        .mt-1{margin-top:4px;}
        .mt-2{margin-top:8px;}
        .mt-3{margin-top:12px;}
        .alert{
            padding:8px 10px;
            border-radius:10px;
            font-size:12px;
            margin-bottom:10px;
        }
        .alert-error{background:#fee2e2;color:#991b1b;}
        .alert-success{background:#dcfce7;color:#166534;}

        /* TABLES */
        table{
            width:100%;
            border-collapse:collapse;
            font-size:13px;
        }
        th,td{
            padding:8px 6px;
            border-bottom:1px solid #e5e7eb;
        }
        th{background:#f3f4f6;text-align:left;}
        .badge{
            display:inline-block;
            padding:2px 8px;
            border-radius:999px;
            font-size:11px;
        }
        .badge-pending{background:#fef3c7;color:#92400e;}
        .badge-shipped{background:#dbeafe;color:#1d4ed8;}
        .badge-delivered{background:#dcfce7;color:#166534;}
        .badge-cancelled{background:#fee2e2;color:#b91c1c;}
        footer{
            background:#0b172a;
            color:#9ca3af;
            font-size:12px;
            padding:12px 0;
            text-align:center;
        }
        @media (max-width:768px){
            .navbar-inner{flex-wrap:wrap;gap:8px;}
            .nav-links{flex-wrap:wrap;justify-content:flex-end;}
        }
    </style>
</head>
<body>
<header class="navbar">
    <div class="container navbar-inner">
        <div class="brand">
            <div class="brand-icon">👓</div>
            <span>OPTISTYLE</span>
        </div>
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="products.php">Shop</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <?php if(isUserLoggedIn()): ?>
                <a href="orders.php">My Orders</a>
                <a href="cart.php">Cart</a>
                <a href="logout.php" class="btn btn-outline">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
