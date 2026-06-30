<?php
require_once "db.php";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $msg   = $_POST['message'];

    $pdo->prepare("INSERT INTO contact_us(name,email,message) VALUES(?,?,?)")
        ->execute([$name,$email,$msg]);

    $_SESSION['success']="Thank you! We have received your message.";
}

include "layout_top.php";
?>

<style>
/* Premium Contact Page Design */

/* Hero Section */
.contact-hero {
    background: linear-gradient(135deg, #0f172a, #1e3a8a);
    padding: 55px 30px;
    border-radius: 22px;
    color: white;
    margin-bottom: 30px;
    text-align: center;
}

.contact-hero h1 {
    font-size: 30px;
    margin-bottom: 8px;
    font-weight: 600;
}

/* Card Layout */
.contact-wrapper {
    display: grid;
    gap: 25px;
}

.contact-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(9px);
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.10);
}

.contact-card h3 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #1e293b;
}

/* Info items */
.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.info-icon {
    font-size: 24px;
    margin-right: 12px;
    color: #1e3a8a;
}

.info-text {
    font-size: 14px;
    color: #334155;
    line-height: 1.5;
}

/* Form Fields */
.form-group input,
.form-group textarea {
    background: #f1f5f9;
    border-radius: 12px;
    border: 1px solid #cbd5e1;
    padding: 10px;
    width: 100%;
    font-size: 14px;
}

.form-group textarea {
    height: 110px;
}

/* Map box */
.map-box {
    width: 100%;
    height: 210px;
    background: #e2e8f0;
    border-radius: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #334155;
    font-weight: 500;
    margin-top: 10px;
    border: 2px dashed #cbd5e1;
}
</style>

<!-- HERO -->
<div class="contact-hero">
    <h1>Contact Us</h1>
    <p style="font-size:14px; opacity:0.85;">We’re here to help you with anything related to OptiStyle eyewear</p>
</div>

<div class="contact-wrapper">

    <!-- LEFT SECTION (Company Info) -->
    <div class="contact-card">
        <h3>Get in Touch</h3>

        <div class="info-item">
            <div class="info-icon">📍</div>
            <div class="info-text">
                <b>OptiStyle Pvt. Ltd.</b><br>
                SG Highway, Ahmedabad,<br>
                Gujarat - 380015
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">📞</div>
            <div class="info-text">
                <b>Customer Support</b><br>
                +91 98765 43210<br>
                (10 AM – 7 PM)
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">✉️</div>
            <div class="info-text">
                <b>Email</b><br>
                support@optistyle.com
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">🕒</div>
            <div class="info-text">
                <b>Working Hours</b><br>
                Mon – Sat | 10:00 AM – 7:00 PM
            </div>
        </div>

        <div class="map-box">
            📌 Location Map Preview
        </div>
    </div>

    <!-- RIGHT SECTION (Form) -->
    <div class="contact-card">

        <?php if(!empty($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <h3>Send us a Message</h3>

        <form method="post">
            <div class="form-group">
                <label>Your Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group" style="margin-top:12px;">
                <label>Your Email</label>
                <input type="email" name="email">
            </div>

            <div class="form-group" style="margin-top:12px;">
                <label>Your Message</label>
                <textarea name="message" required></textarea>
            </div>

            <button class="btn btn-primary mt-2" style="width:100%; margin-top:15px;">
                Send Message
            </button>
        </form>
    </div>

</div>

<?php include "layout_bottom.php"; ?>
