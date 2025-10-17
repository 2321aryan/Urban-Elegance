<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$property_id = $_GET['id'] ?? 0;

if (!$property_id) {
    header("Location: properties.php");
    exit;
}

// Get property details
$property = getPropertyById($property_id);

if (!$property) {
    header("Location: properties.php");
    exit;
}

$images = $property['images'] ? json_decode($property['images'], true) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($property['title']); ?> - Urban Elegance</title>
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
                    <?php if (isLoggedIn()): ?>
                        <li><a href="dashboard/<?php echo $_SESSION['role']; ?>_dashboard.php">Dashboard</a></li>
                        <li><a href="auth/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="register.html">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Database Status -->
    <?php echo showDatabaseStatus(); ?>

    <div style="max-width: 1200px; margin: 2rem auto; padding: 0 20px;">
        <!-- Property Images -->
        <div style="margin-bottom: 2rem;">
            <?php if (!empty($images)): ?>
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; height: 400px;">
                    <div style="background: #f0f0f0; border-radius: 10px; overflow: hidden;">
                        <img src="uploads/<?php echo $images[0]; ?>" alt="Property Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="display: grid; grid-template-rows: 1fr 1fr; gap: 1rem;">
                        <?php for ($i = 1; $i < min(3, count($images)); $i++): ?>
                            <div style="background: #f0f0f0; border-radius: 10px; overflow: hidden;">
                                <img src="uploads/<?php echo $images[$i]; ?>" alt="Property Image" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php else: ?>
                <div style="height: 400px; background: #f0f0f0; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #666;">
                    No Images Available
                </div>
            <?php endif; ?>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
            <!-- Property Details -->
            <div>
                <h1 style="font-size: 2rem; margin-bottom: 1rem; color: #333;"><?php echo htmlspecialchars($property['title']); ?></h1>
                
                <div style="display: flex; align-items: center; gap: 2rem; margin-bottom: 2rem; padding: 1rem; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div>
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea;">₹<?php echo number_format($property['rent_amount']); ?></div>
                        <div style="color: #666;">per month</div>
                    </div>
                    <div style="border-left: 2px solid #eee; padding-left: 2rem;">
                        <div style="display: flex; gap: 2rem; font-size: 1.1rem;">
                            <span><strong><?php echo $property['bedrooms']; ?></strong> BHK</span>
                            <span><strong><?php echo $property['bathrooms']; ?></strong> Bath</span>
                            <span><strong><?php echo number_format($property['area_sqft']); ?></strong> sq ft</span>
                        </div>
                    </div>
                </div>

                <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 1rem;">Property Details</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div><strong>Type:</strong> <?php echo ucfirst($property['property_type']); ?></div>
                        <div><strong>Furnished:</strong> <?php echo ucfirst($property['furnished']); ?></div>
                        <div><strong>Parking:</strong> <?php echo $property['parking'] ? 'Available' : 'Not Available'; ?></div>
                        <div><strong>Security Deposit:</strong> ₹<?php echo number_format($property['deposit_amount']); ?></div>
                    </div>
                </div>

                <?php if ($property['description']): ?>
                <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 1rem;">Description</h3>
                    <p style="line-height: 1.6; color: #666;"><?php echo nl2br(htmlspecialchars($property['description'])); ?></p>
                </div>
                <?php endif; ?>

                <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h3 style="margin-bottom: 1rem;">Location</h3>
                    <p style="color: #666; line-height: 1.6;">
                        <?php echo htmlspecialchars($property['address']); ?><br>
                        <?php echo htmlspecialchars($property['city'] . ', ' . $property['state'] . ' - ' . $property['pincode']); ?>
                    </p>
                </div>
            </div>

            <!-- Contact Owner -->
            <div>
                <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: sticky; top: 2rem;">
                    <h3 style="margin-bottom: 1rem;">Contact Owner</h3>
                    
                    <div style="margin-bottom: 2rem;">
                        <div style="font-weight: bold; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($property['owner_name']); ?></div>
                        <div style="color: #666; margin-bottom: 0.5rem;">📞 <?php echo htmlspecialchars($property['owner_phone']); ?></div>
                        <div style="color: #666;">✉️ <?php echo htmlspecialchars($property['owner_email']); ?></div>
                    </div>

                    <?php if (isLoggedIn() && hasRole('tenant')): ?>
                        <div style="margin-bottom: 1rem;">
                            <a href="send_inquiry.php?id=<?php echo $property['id']; ?>" class="btn btn-secondary" style="width: 100%; text-align: center; display: block; text-decoration: none; margin-bottom: 0.5rem;">Send Inquiry</a>
                        </div>
                        
                        <!-- Payment Options -->
                        <div style="border-top: 1px solid #eee; padding-top: 1rem;">
                            <h4 style="margin-bottom: 1rem; color: #333;">💳 Quick Payments</h4>
                            <a href="payment.php?property_id=<?php echo $property['id']; ?>&type=booking" class="btn btn-primary" style="width: 100%; text-align: center; display: block; text-decoration: none; margin-bottom: 0.5rem;">
                                Book Now - ₹<?php echo number_format($property['rent_amount'] * 0.1); ?>
                            </a>
                            <a href="payment.php?property_id=<?php echo $property['id']; ?>&type=rent" class="btn btn-success" style="width: 100%; text-align: center; display: block; text-decoration: none; margin-bottom: 0.5rem;">
                                Pay Rent - ₹<?php echo number_format($property['rent_amount']); ?>
                            </a>
                            <?php if ($property['deposit_amount'] > 0): ?>
                            <a href="payment.php?property_id=<?php echo $property['id']; ?>&type=deposit" class="btn" style="width: 100%; text-align: center; display: block; text-decoration: none; background: #ffc107; color: #000;">
                                Pay Deposit - ₹<?php echo number_format($property['deposit_amount']); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                    <?php elseif (!isLoggedIn()): ?>
                        <div style="text-align: center;">
                            <p style="margin-bottom: 1rem; color: #666;">Login to contact owner & make payments</p>
                            <a href="login.html" class="btn btn-primary" style="width: 100%; text-align: center; display: block; text-decoration: none;">Login</a>
                        </div>
                    <?php else: ?>
                        <div style="text-align: center; color: #666;">
                            <p>Only tenants can send inquiries and make payments</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background: #333; color: white; text-align: center; padding: 2rem 0; margin-top: 3rem;">
        <p>&copy; 2024 Urban Elegance. All rights reserved.</p>
    </footer>
</body>
</html>