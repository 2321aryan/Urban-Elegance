<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

requireLogin();

$property_id = $_GET['property_id'] ?? 0;
$payment_type = $_GET['type'] ?? 'rent'; // rent, deposit, booking

if (!$property_id) {
    header("Location: properties.php");
    exit;
}

// Get property details
$stmt = $pdo->prepare("
    SELECT p.*, u.full_name as owner_name, u.phone as owner_phone 
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

// Calculate payment amount based on type
$amount = 0;
$payment_title = '';
switch($payment_type) {
    case 'rent':
        $amount = $property['rent_amount'];
        $payment_title = 'Monthly Rent Payment';
        break;
    case 'deposit':
        $amount = $property['deposit_amount'];
        $payment_title = 'Security Deposit Payment';
        break;
    case 'booking':
        $amount = $property['rent_amount'] * 0.1; // 10% booking amount
        $payment_title = 'Booking Amount Payment';
        break;
}

// Handle payment processing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];
    $transaction_id = 'TXN' . time() . rand(1000, 9999);
    
    try {
        // Insert payment record
        $stmt = $pdo->prepare("
            INSERT INTO payments (property_id, tenant_id, owner_id, amount, payment_type, payment_method, transaction_id, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'completed')
        ");
        $stmt->execute([$property_id, $_SESSION['user_id'], $property['owner_id'], $amount, $payment_type, $payment_method, $transaction_id]);
        
        // Redirect to success page
        header("Location: payment_success.php?txn=" . $transaction_id);
        exit;
    } catch (Exception $e) {
        $error_message = "Payment failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Urban Elegance</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .payment-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 20px;
        }
        .payment-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .payment-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            padding: 2rem;
        }
        .payment-method {
            border: 2px solid #eee;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .payment-method:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }
        .payment-method.selected {
            border-color: #667eea;
            background: #f8f9ff;
        }
        .payment-method img {
            width: 60px;
            height: 40px;
            object-fit: contain;
            margin-bottom: 1rem;
        }
        .property-summary {
            background: #f8f9fa;
            padding: 1.5rem;
            margin: 1rem 2rem;
            border-radius: 10px;
        }
        .amount-display {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            text-align: center;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">Urban Elegance - Payment</div>
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

    <div class="payment-container">
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="alert alert-error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <div class="payment-card">
            <div class="payment-header">
                <h2><?php echo $payment_title; ?></h2>
                <div class="amount-display">₹<?php echo number_format($amount, 2); ?></div>
            </div>

            <!-- Property Summary -->
            <div class="property-summary">
                <h4><?php echo htmlspecialchars($property['title']); ?></h4>
                <p><strong>Owner:</strong> <?php echo htmlspecialchars($property['owner_name']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($property['city'] . ', ' . $property['state']); ?></p>
                <p><strong>Payment Type:</strong> <?php echo ucfirst($payment_type); ?></p>
            </div>

            <!-- Payment Form -->
            <form method="POST" id="paymentForm">
                <div class="payment-methods">
                    <div class="payment-method" onclick="selectPayment('upi')">
                        <div style="font-size: 2rem; color: #667eea;">📱</div>
                        <h4>UPI Payment</h4>
                        <p>Pay using UPI apps</p>
                        <input type="radio" name="payment_method" value="upi" style="display: none;">
                    </div>

                    <div class="payment-method" onclick="selectPayment('card')">
                        <div style="font-size: 2rem; color: #667eea;">💳</div>
                        <h4>Credit/Debit Card</h4>
                        <p>Visa, Mastercard, Rupay</p>
                        <input type="radio" name="payment_method" value="card" style="display: none;">
                    </div>

                    <div class="payment-method" onclick="selectPayment('netbanking')">
                        <div style="font-size: 2rem; color: #667eea;">🏦</div>
                        <h4>Net Banking</h4>
                        <p>All major banks</p>
                        <input type="radio" name="payment_method" value="netbanking" style="display: none;">
                    </div>

                    <div class="payment-method" onclick="selectPayment('wallet')">
                        <div style="font-size: 2rem; color: #667eea;">👛</div>
                        <h4>Digital Wallet</h4>
                        <p>Paytm, PhonePe, GPay</p>
                        <input type="radio" name="payment_method" value="wallet" style="display: none;">
                    </div>
                </div>

                <!-- Payment Details Section -->
                <div id="paymentDetails" style="display: none; padding: 2rem;">
                    <!-- UPI Details -->
                    <div id="upiDetails" class="payment-details" style="display: none;">
                        <h4>UPI Payment</h4>
                        <div style="text-align: center; margin: 2rem 0;">
                            <div style="background: white; padding: 2rem; border-radius: 10px; display: inline-block;">
                                <div style="font-size: 4rem;">📱</div>
                                <p><strong>UPI ID:</strong> urbanelegance@paytm</p>
                                <p><strong>Amount:</strong> ₹<?php echo number_format($amount, 2); ?></p>
                                <p>Scan QR code or use UPI ID</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Details -->
                    <div id="cardDetails" class="payment-details" style="display: none;">
                        <h4>Card Payment</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <input type="text" placeholder="MM/YY" maxlength="5">
                            </div>
                            <div class="form-group">
                                <label>CVV</label>
                                <input type="text" placeholder="123" maxlength="3">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cardholder Name</label>
                            <input type="text" placeholder="Name on card">
                        </div>
                    </div>

                    <!-- Net Banking Details -->
                    <div id="netbankingDetails" class="payment-details" style="display: none;">
                        <h4>Net Banking</h4>
                        <div class="form-group">
                            <label>Select Your Bank</label>
                            <select>
                                <option>State Bank of India</option>
                                <option>HDFC Bank</option>
                                <option>ICICI Bank</option>
                                <option>Axis Bank</option>
                                <option>Punjab National Bank</option>
                                <option>Bank of Baroda</option>
                                <option>Other Banks</option>
                            </select>
                        </div>
                    </div>

                    <!-- Wallet Details -->
                    <div id="walletDetails" class="payment-details" style="display: none;">
                        <h4>Digital Wallet</h4>
                        <div class="form-group">
                            <label>Select Wallet</label>
                            <select>
                                <option>Paytm</option>
                                <option>PhonePe</option>
                                <option>Google Pay</option>
                                <option>Amazon Pay</option>
                                <option>Mobikwik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="tel" placeholder="Enter mobile number">
                        </div>
                    </div>
                </div>

                <div style="padding: 2rem; text-align: center;">
                    <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem; font-size: 1.1rem;" disabled id="payButton">
                        Pay ₹<?php echo number_format($amount, 2); ?>
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Info -->
        <div style="text-align: center; margin-top: 2rem; color: #666;">
            <p>🔒 Your payment is secured with 256-bit SSL encryption</p>
            <p>💳 We support all major payment methods</p>
        </div>
    </div>

    <script>
        function selectPayment(method) {
            // Remove selected class from all methods
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Add selected class to clicked method
            event.currentTarget.classList.add('selected');
            
            // Set radio button
            document.querySelector(`input[value="${method}"]`).checked = true;
            
            // Show payment details
            document.getElementById('paymentDetails').style.display = 'block';
            
            // Hide all payment detail sections
            document.querySelectorAll('.payment-details').forEach(el => {
                el.style.display = 'none';
            });
            
            // Show selected payment details
            document.getElementById(method + 'Details').style.display = 'block';
            
            // Enable pay button
            document.getElementById('payButton').disabled = false;
        }

        // Form submission with confirmation
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!selectedMethod) {
                alert('Please select a payment method');
                return;
            }
            
            if (confirm(`Confirm payment of ₹<?php echo number_format($amount, 2); ?> using ${selectedMethod.value.toUpperCase()}?`)) {
                // Simulate payment processing
                const payButton = document.getElementById('payButton');
                payButton.textContent = 'Processing...';
                payButton.disabled = true;
                
                setTimeout(() => {
                    this.submit();
                }, 2000);
            }
        });
    </script>
</body>
</html>