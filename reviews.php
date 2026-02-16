<?php
include 'db.php';

$reviews = $conn->query("
    SELECT r.*, c.name as car_name, c.image 
    FROM reviews r 
    JOIN cars c ON r.car_id = c.id 
    WHERE r.approved = 1 
    ORDER BY r.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews - Car Rental</title>
    <link rel="stylesheet" href="style.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <h1>Customer Reviews</h1>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="car.php"><i class="fas fa-car"></i> Our Cars</a>
            <a href="contact.php"><i class="fas fa-calendar-check"></i> Reservation</a>
            <a href="reviews.php"><i class="fas fa-star"></i> Reviews</a>
        </nav>
    </header>

    <section>
        <h2><i class="fas fa-comments"></i> What Our Customers Say</h2>
        
        <div class="reviews-grid">
            <?php if($reviews->num_rows > 0): ?>
                <?php while($review = $reviews->fetch_assoc()): ?>
                    <div class="review-card">
                        <div class="review-header">
                            <div>
                                <h3><?= htmlspecialchars($review['customer_name']) ?></h3>
                                <div class="review-stars">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $review['rating']): ?>
                                            <i class="fas fa-star"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php if($review['review_title']): ?>
                            <h4><?= htmlspecialchars($review['review_title']) ?></h4>
                        <?php endif; ?>
                        
                        <p class="review-text"><?= htmlspecialchars($review['review_text']) ?></p>
                        
                        <div class="review-footer">
                            <span class="car-tag"><i class="fas fa-car"></i> <?= htmlspecialchars($review['car_name']) ?></span>
                            <span class="review-date"><i class="far fa-clock"></i> <?= date('F j, Y', strtotime($review['created_at'])) ?></span>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-reviews">
                    <i class="fas fa-star"></i>
                    <h3>No Reviews Yet</h3>
                    <p>Be the first to review a car!</p>
                    <a href="car.php"><button><i class="fas fa-car"></i> Browse Cars</button></a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>