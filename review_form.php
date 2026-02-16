<?php
include 'db.php';

$car_id = isset($_GET['car_id']) ? (int)$_GET['car_id'] : 0;
$car = $conn->query("SELECT * FROM cars WHERE id = $car_id")->fetch_assoc();

if (!$car) {
    header("Location: car.php");
    exit;
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $rating = (int)$_POST['rating'];
    $review_title = $_POST['review_title'];
    $review_text = $_POST['review_text'];
    $car_id = $_POST['car_id'];
    
    $stmt = $conn->prepare("INSERT INTO reviews (car_id, customer_name, customer_email, rating, review_title, review_text, approved) VALUES (?, ?, ?, ?, ?, ?, 1)");
    $stmt->bind_param("ississ", $car_id, $customer_name, $customer_email, $rating, $review_title, $review_text);
    
    if ($stmt->execute()) {
        $conn->query("UPDATE cars c SET rating = (SELECT AVG(rating) FROM reviews WHERE car_id = $car_id AND approved = 1), reviews_count = (SELECT COUNT(*) FROM reviews WHERE car_id = $car_id AND approved = 1) WHERE id = $car_id");
        $message = "✅ Thank you! Your review has been posted.";
    } else {
        $message = "❌ Error: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate <?= htmlspecialchars($car['name']) ?></title>
    <link rel="stylesheet" href="style.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <h1>Rate Your Experience</h1>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="car.php"><i class="fas fa-car"></i> Our Cars</a>
            <a href="contact.php"><i class="fas fa-calendar-check"></i> Reservation</a>
            <a href="reviews.php"><i class="fas fa-star"></i> Reviews</a>
        </nav>
    </header>

    <section>
        <div class="car-info">
            <h2><?= htmlspecialchars($car['name']) ?></h2>
            <p>Current rating: 
                <?php 
                $rating = $car['rating'] ?? 0;
                for($i = 1; $i <= 5; $i++): 
                    if($i <= $rating): ?>
                        <i class="fas fa-star" style="color: #ffc107;"></i>
                    <?php elseif($i - 0.5 <= $rating): ?>
                        <i class="fas fa-star-half-alt" style="color: #ffc107;"></i>
                    <?php else: ?>
                        <i class="far fa-star" style="color: #ffc107;"></i>
                    <?php endif; ?>
                <?php endfor; ?>
                (<?= number_format($car['rating'] ?? 0, 1) ?>/5 - <?= $car['reviews_count'] ?? 0 ?> reviews)
            </p>
        </div>
        
        <?php if($message): ?>
            <div class="alert <?= strpos($message, '✅') !== false ? 'alert-success' : 'alert-error' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="" class="review-form">
            <input type="hidden" name="car_id" value="<?= $car_id ?>">
            
            <h3><i class="fas fa-pen"></i> Write Your Review</h3>
            
            <label>Your Rating:</label>
            <div class="star-rating">
                <input type="radio" name="rating" value="5" id="rate5" required><label for="rate5">★</label>
                <input type="radio" name="rating" value="4" id="rate4"><label for="rate4">★</label>
                <input type="radio" name="rating" value="3" id="rate3"><label for="rate3">★</label>
                <input type="radio" name="rating" value="2" id="rate2"><label for="rate2">★</label>
                <input type="radio" name="rating" value="1" id="rate1"><label for="rate1">★</label>
            </div>
            
            <div class="form-row">
                <input type="text" name="customer_name" placeholder="Your Name" required>
                <input type="email" name="customer_email" placeholder="Your Email" required>
            </div>
            
            <input type="text" name="review_title" placeholder="Review Title (optional)">
            <textarea name="review_text" placeholder="Your review..." rows="5" required></textarea>
            
            <div class="form-actions">
                <button type="submit"><i class="fas fa-paper-plane"></i> Submit Review</button>
                <a href="car.php" class="btn-secondary"><i class="fas fa-arrow-left"></i> Back to Cars</a>
            </div>
        </form>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>