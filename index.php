<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental - Drive Your Dreams</title>
    <link rel="stylesheet" href="style.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <h1>Car Rental</h1>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="car.php"><i class="fas fa-car"></i> Our Cars</a>
            <a href="contact.php"><i class="fas fa-calendar-check"></i> Reservation</a>
            <a href="reviews.php"><i class="fas fa-star"></i> Reviews</a>
        </nav>
    </header>

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <img src="images/banner.jpg" alt="Luxury Car Rental" class="hero-image">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1 class="hero-title">Drive Your Dreams</h1>
                <p class="hero-subtitle">Premium car rental at affordable prices • Free cancellation • 24/7 support</p>
                <div class="hero-buttons">
                    <a href="car.php" class="hero-btn primary"><i class="fas fa-car-side"></i> Browse Cars</a>
                    <a href="contact.php" class="hero-btn secondary"><i class="fas fa-calendar-check"></i> Book Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- FEATURES SECTION -->
    <section class="features-section">
        <h2>Why Choose Us?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                <h3>Fast & Easy</h3>
                <p>Book your car in minutes with our simple reservation system</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Fully Insured</h3>
                <p>All rentals include comprehensive insurance for peace of mind</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-headset"></i></div>
                <h3>24/7 Support</h3>
                <p>Our team is always here to help you, anytime, anywhere</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-tags"></i></div>
                <h3>Best Prices</h3>
                <p>We guarantee the lowest rates with no hidden fees</p>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <div class="cta-section">
        <h2>Ready to hit the road?</h2>
        <p>Choose from our wide range of vehicles and start your journey today</p>
        <a href="car.php" class="cta-button"><i class="fas fa-car"></i> View Our Fleet</a>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>