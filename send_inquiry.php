<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

requireLogin();

if (!hasRole('tenant')) {
    header("Location: index.html");
    exit;
}

$property_id = $_GET['id'] ?? 0;

if (!$property_id) {
    header("Location: properties.php");
    exit;
}

// Get property details
$stmt = $pdo->prepare("
    SELECT p.*, u.full_name as owner_name 
    FROM properties p 
    JOIN users u ON p.owner_id = u.id 
    WHERE p.id = ? AND p.status = 'approved'
");
$stmt->execute([$property_id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    header("Location: properties.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inquiry_message = sanitize($_POST['message']);
    
    if (!empty($inquiry_message)) {
        try {
            // Check if user already sent inquiry for this property
            $stmt = $pdo->prepare("SELECT id FROM inquiries WHERE property_id = ? AND tenant_id = ?");
            $stmt->execute([$property_id, $_SESSION['user_id']]);
            
            if ($stmt->fetch()) {
                $message = '<div class="alert alert-info">You have already sent an inquiry for this property.</div>';
            } else {
                $stmt = $pdo->prepare("
                    INSERT INTO inquiries (property_id, tenant_id, owner_id, message) 
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->execute([$property_id, $_SESSION['user_id'], $property['owner_id'], $inquiry_message]);
                
                $message = '<div class="alert alert-success">Your inquiry has been sent successfully!</div>';
            }
        } catch (Exception $e) {
            $message = '<div class="alert alert-error">Error sending inquiry. Please try again.</div>';
        }
    } else {
        $message = '<div class="alert alert-error">Please enter a message.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Inquiry - Urban Elegance</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">Urban Elegance</div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="properties.php">Properties</a></li>
                    <li><a href="dashboard/user_dashboard.php">Dashboard</a></li>
                    <li><a href="auth/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="form-container">
        <h2 class="form-title">Send Inquiry</h2>
        
        <!-- Property Summary -->
        <div style="background: #f8f9fa; padding: 1rem; border-radius: 5px; margin-bottom: 2rem;">
            <h4><?php echo htmlspecialchars($property['title']); ?></h4>
            <p style="color: #666; margin: 0.5rem 0;">₹<?php echo number_format($property['rent_amount']); ?>/month</p>
            <p style="color: #666; margin: 0;">Owner: <?php echo htmlspecialchars($property['owner_name']); ?></p>
        </div>
        
        <?php echo $message; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="6" placeholder="Hi, I'm interested in this property. Please provide more details about availability, viewing schedule, and any additional requirements." style="width: 100%; padding: 0.8rem; border: 2px solid #ddd; border-radius: 5px;" required></textarea>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Inquiry</button>
            </div>
        </form>
        
        <div style="text-align: center; margin-top: 1rem;">
            <a href="property_details.php?id=<?php echo $property_id; ?>">← Back to Property Details</a>
        </div>
    </div>
</body>
</html>