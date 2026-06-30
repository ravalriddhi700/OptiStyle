<?php include "layout_top.php"; ?>

<style>
/* Extra internal CSS only for this page */

/* Hero banner */
.about-hero {
    background: linear-gradient(135deg, #0b172a, #1e3a8a);
    color: white;
    padding: 40px 30px;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 25px;
}

.about-hero h1 {
    font-size: 28px;
    margin-bottom: 10px;
}

.about-hero p {
    font-size: 14px;
    opacity: 0.85;
}

/* Info section */
.about-section {
    background: #ffffff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(15,23,42,0.08);
    margin-bottom: 25px;
}

/* Features grid */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 18px;
    margin-top: 15px;
}

.feature-card {
    background: #fafcff;
    border-radius: 18px;
    padding: 18px;
    text-align: center;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    transition: 0.25s;
}

.feature-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.15);
}

.feature-icon {
    font-size: 28px;
    margin-bottom: 8px;
}

/* Mission & Vision */
.mv-box {
    padding: 18px;
    background: #f3f6fb;
    border-radius: 18px;
    margin-top: 20px;
}

.mv-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #1e3a8a;
}

/* Why Choose Us Section */
.why-choose {
    background: #ffffff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(15,23,42,0.08);
}

.why-item {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
    font-size: 14px;
}

.why-icon {
    font-size: 20px;
    margin-right: 10px;
    color: var(--primary-dark);
}
</style>

<!-- HERO -->
<div class="about-hero">
    <h1>About OptiStyle 👓</h1>
    <p>Your trusted destination for premium and stylish eyewear</p>
</div>

<!-- INTRO -->
<div class="about-section">
    <p style="font-size:15px; line-height:1.7;">
        OptiStyle is India's modern eyewear platform inspired by the clean and premium user 
        experience of Lenskart. Our goal is to offer top-quality frames, sunglasses & 
        computer glasses at prices that everyone can afford—without compromising on style 
        or comfort.
    </p>

    <p style="margin-top:10px;font-size:15px;line-height:1.7;">
        We blend technology, fashion and comfort to deliver eyewear that not only looks 
        good but feels great. Whether you need power glasses, anti-blue light frames, 
        premium sunglasses or kids eyewear—OptiStyle has it all.
    </p>

    <h3 style="margin-top:20px;font-size:17px;">Our Core Features</h3>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🕶️</div>
            <div><strong>Premium Frames</strong></div>
            <p style="font-size:12px;opacity:0.8;">Trendy designs with durable materials.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <div><strong>Fast Delivery</strong></div>
            <p style="font-size:12px;opacity:0.8;">Delivered quickly via our trusted e-Cart partners.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">💸</div>
            <div><strong>Affordable Prices</strong></div>
            <p style="font-size:12px;opacity:0.8;">Stylish eyewear for every budget.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🔍</div>
            <div><strong>High Clarity Lenses</strong></div>
            <p style="font-size:12px;opacity:0.8;">Perfect vision with premium quality lenses.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🧒</div>
            <div><strong>Kids Friendly</strong></div>
            <p style="font-size:12px;opacity:0.8;">Soft, safe & comfortable eyewear for kids.</p>
        </div>
    </div>
</div>

<!-- MISSION & VISION -->
<div class="mv-box">
    <div class="mv-title">Our Mission</div>
    <p style="font-size:14px;line-height:1.6;">
        To make high-quality eyewear accessible to every Indian household with a blend 
        of style, comfort, and affordability.
    </p>

    <div class="mv-title" style="margin-top:15px;">Our Vision</div>
    <p style="font-size:14px;line-height:1.6;">
        To become India’s most trusted and loved eyewear brand with exceptional customer 
        experience and modern technology.
    </p>
</div>

<!-- WHY CHOOSE US -->
<div class="why-choose" style="margin-top:25px;">
    <h3 style="font-size:17px;margin-bottom:15px;">Why Choose OptiStyle?</h3>

    <div class="why-item">
        <div class="why-icon">⭐</div> High-quality frames with stylish designs
    </div>
    <div class="why-item">
        <div class="why-icon">📦</div> Reliable e-Cart delivery service
    </div>
    <div class="why-item">
        <div class="why-icon">💳</div> Easy COD payment option
    </div>
    <div class="why-item">
        <div class="why-icon">📞</div> Quick customer support & assistance
    </div>
    <div class="why-item">
        <div class="why-icon">🛡️</div> Trusted by students, professionals & families
    </div>
</div>

<?php include "layout_bottom.php"; ?>
