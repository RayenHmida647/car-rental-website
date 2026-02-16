<?php
include 'db.php';

$message = "";
$car_id = isset($_GET['car_id']) ? (int)$_GET['car_id'] : 0;
$car_name = '';
$price_per_day = 0;

if ($car_id) {
    $car_result = $conn->query("SELECT * FROM cars WHERE id = $car_id");
    if ($car_result->num_rows > 0) {
        $car = $car_result->fetch_assoc();
        $car_name = $car['name'];
        $price_per_day = $car['price_per_day'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $car_id = (int)$_POST['car_id'];
    $car_name = $_POST['car_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $user_message = $_POST['message'] ?? '';
    
    $datetime1 = new DateTime($start_date);
    $datetime2 = new DateTime($end_date);
    $days = $datetime1->diff($datetime2)->days;
    $total_price = $days * $price_per_day;
    
    $stmt = $conn->prepare("INSERT INTO reservations (first_name, last_name, email, phone, car_id, car_name, start_date, end_date, price_per_day, total_price, days, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisssddis", $first_name, $last_name, $email, $phone, $car_id, $car_name, $start_date, $end_date, $price_per_day, $total_price, $days, $user_message);
    
    if ($stmt->execute()) {
        $message = "✅ Reservation successful! Total: " . number_format($total_price, 2, ',', ' ') . "€ for $days days";
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
    <title>Reservation - Car Rental</title>
    <link rel="stylesheet" href="style.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <h1>Book Your Car</h1>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="car.php"><i class="fas fa-car"></i> Our Cars</a>
            <a href="contact.php"><i class="fas fa-calendar-check"></i> Reservation</a>
            <a href="reviews.php"><i class="fas fa-star"></i> Reviews</a>
        </nav>
    </header>

    <section>
        <h2><i class="fas fa-calendar-alt"></i> Reservation Form</h2>
        
        <?php if($message): ?>
            <div class="alert <?= strpos($message, '✅') !== false ? 'alert-success' : 'alert-error' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="" class="reservation-form">
            <input type="hidden" name="car_id" value="<?= $car_id ?>">
            <input type="hidden" name="price_per_day" value="<?= $price_per_day ?>">
            
            <div class="form-row">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            
            <div class="form-row">
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
            
            <div class="form-row">
                <input type="text" name="car_name" value="<?= htmlspecialchars($car_name) ?>" placeholder="Car" required readonly>
            </div>
            
            <div class="form-row">
                <div class="date-field">
                    <label><i class="fas fa-calendar-plus"></i> Start Date:</label>
                    <input type="date" name="start_date" min="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="date-field">
                    <label><i class="fas fa-calendar-check"></i> End Date:</label>
                    <input type="date" name="end_date" min="<?= date('Y-m-d') ?>" required>
                </div>
            </div>
            
            <textarea name="message" placeholder="Additional message (optional)" rows="4"></textarea>
            
            <button type="submit" class="btn-submit"><i class="fas fa-check-circle"></i> Confirm Reservation</button>
        </form>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>