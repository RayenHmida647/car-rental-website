<?php
include 'db.php';

$cars_per_page = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $cars_per_page;

$total_result = $conn->query("SELECT COUNT(*) as total FROM cars WHERE available = 1");
$total_row = $total_result->fetch_assoc();
$total_cars = $total_row['total'];
$total_pages = ceil($total_cars / $cars_per_page);

$cars = $conn->query("SELECT * FROM cars WHERE available = 1 ORDER BY rating DESC, id DESC LIMIT $offset, $cars_per_page");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Cars - Car Rental</title>
    <link rel="stylesheet" href="style.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <h1>Our Available Cars</h1>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="car.php"><i class="fas fa-car"></i> Our Cars</a>
            <a href="contact.php"><i class="fas fa-calendar-check"></i> Reservation</a>
            <a href="reviews.php"><i class="fas fa-star"></i> Reviews</a>
        </nav>
    </header>

    <section>
        <div class="section-header">
            <h2><i class="fas fa-car"></i> Choose Your Vehicle</h2>
            <span class="car-count"><i class="fas fa-flag-checkered"></i> <?= $total_cars ?> cars available</span>
        </div>
        
        <div class="cars-container">
            <?php if ($cars && $cars->num_rows > 0): ?>
                <?php while($car = $cars->fetch_assoc()): 
                    $rating = $car['rating'] ?? 0;
                    $reviews_count = $car['reviews_count'] ?? 0;
                    $full_stars = floor($rating);
                    $half_star = ($rating - $full_stars) >= 0.5;
                    $image_path = 'images/' . $car['image'];
                    if (!file_exists($image_path)) $image_path = 'images/default-car.jpg';
                ?>
                    <div class="car-card">
                        <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($car['name']) ?>">
                        <div class="car-card-content">
                            <h3><?= htmlspecialchars($car['name']) ?></h3>
                            <p><?= htmlspecialchars($car['description']) ?></p>
                            
                            <div class="stars">
                                <?php if($rating > 0): ?>
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $full_stars): ?>
                                            <i class="fas fa-star"></i>
                                        <?php elseif($i == $full_stars + 1 && $half_star): ?>
                                            <i class="fas fa-star-half-alt"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <span class="rating-text">(<?= number_format($rating, 1) ?> • <?= $reviews_count ?> <?= $reviews_count > 1 ? 'reviews' : 'review' ?>)</span>
                                <?php else: ?>
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class="far fa-star"></i>
                                    <?php endfor; ?>
                                    <span class="rating-text">(0 reviews)</span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="price"><?= number_format($car['price_per_day'], 2, ',', ' ') ?> € <span>per day</span></div>
                            
                            <div class="car-buttons">
                                <a href="contact.php?car_id=<?= $car['id'] ?>"><button><i class="fas fa-calendar-check"></i> Book Now</button></a>
                                <a href="review_form.php?car_id=<?= $car['id'] ?>"><button class="btn-rate"><i class="fas fa-star"></i> Rate</button></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-cars">
                    <i class="fas fa-car-side"></i>
                    <h3>No Cars Available</h3>
                    <p>We are currently updating our fleet. Please check back later!</p>
                    <a href="index.php"><button><i class="fas fa-home"></i> Back to Home</button></a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- PAGINATION -->
        <?php if($total_pages > 1): ?>
        <div class="pagination">
            <?php if($page > 1): ?>
                <a href="?page=<?= $page-1 ?>"><i class="fas fa-chevron-left"></i> Previous</a>
            <?php else: ?>
                <span class="disabled"><i class="fas fa-chevron-left"></i> Previous</span>
            <?php endif; ?>
            
            <?php if($page > 3): ?>
                <a href="?page=1">1</a>
                <?php if($page > 4) echo '<span class="dots">...</span>'; ?>
            <?php endif; ?>
            
            <?php for($i = max(1, $page-2); $i <= min($total_pages, $page+2); $i++): ?>
                <?php if($i == $page): ?>
                    <span class="active"><?= $i ?></span>
                <?php else: ?>
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if($page < $total_pages-2): ?>
                <?php if($page < $total_pages-3) echo '<span class="dots">...</span>'; ?>
                <a href="?page=<?= $total_pages ?>"><?= $total_pages ?></a>
            <?php endif; ?>
            
            <?php if($page < $total_pages): ?>
                <a href="?page=<?= $page+1 ?>">Next <i class="fas fa-chevron-right"></i></a>
            <?php else: ?>
                <span class="disabled">Next <i class="fas fa-chevron-right"></i></span>
            <?php endif; ?>
        </div>
        <div class="page-info">Page <?= $page ?> of <?= $total_pages ?> • <?= $total_cars ?> total vehicles</div>
        <?php endif; ?>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>