<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

requireLogin();

$transaction_id = $_GET['txn'] ?? '';

if ($transaction_id) {
    $stmt = $pdo->prepare("
        SELECT p.*, pr.title as property_title, u.full_name as owner_name 
        FROM payments p 
        JOIN properties pr ON p.property_id = pr.id 
        JOIN users u ON p.owner_id = u.id 
        WHERE p.transaction_id = ? AND p.tenant_id = ?
    ");
    $stmt->execute([$transaction_id, $_SESSION['user_id']]);
    $payment = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - Urban Elegance</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .success-container {
            max-width: 600px;
            margin: 3rem auto;
            text-align: center;
            padding: 0 20px;
        }
        .success-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 3rem 2rem;
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }
        .transaction-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem 0;
            text-align: left;
        }
    </style>
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

    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">✅</div>
            <h2 style="color: #28a745; margin-bottom: 1rem;">Payment Successful!</h2>
            <p style="color: #666; font-size: 1.1rem;">Your payment has been processed successfully.</p>

            <?php if (isset($payment)): ?>
            <div class="transaction-details">
                <h4 style="margin-bottom: 1rem;">Transaction Details</h4>
                <div style="display: grid; gap: 0.5rem;">
                    <div><strong>Transaction ID:</strong> <?php echo htmlspecialchars($payment['transaction_id']); ?></div>
                    <div><strong>Property:</strong> <?php echo htmlspecialchars($payment['property_title']); ?></div>
                    <div><strong>Amount:</strong> ₹<?php echo number_format($payment['amount'], 2); ?></div>
                    <div><strong>Payment Type:</strong> <?php echo ucfirst($payment['payment_type']); ?></div>
                    <div><strong>Payment Method:</strong> <?php echo strtoupper($payment['payment_method']); ?></div>
                    <div><strong>Date:</strong> <?php echo date('M d, Y H:i', strtotime($payment['payment_date'])); ?></div>
                    <div><strong>Owner:</strong> <?php echo htmlspecialchars($payment['owner_name']); ?></div>
                </div>
            </div>
            <?php endif; ?>

            <div style="margin-top: 2rem;">
                <a href="dashboard/user_dashboard.php" class="btn btn-primary" style="margin-right: 1rem;">View Dashboard</a>
                <a href="properties.php" class="btn btn-secondary">Browse More Properties</a>
            </div>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #eee; color: #666;">
                <p>📧 A payment confirmation has been sent to your email</p>
                <p>📱 You can track your payments in your dashboard</p>
            </div>
        </div>
    </div>
</body>
</html>