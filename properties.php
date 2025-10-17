<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Get search filters
$filters = [
    'city' => $_GET['city'] ?? '',
    'property_type' => $_GET['property_type'] ?? '',
    'min_rent' => $_GET['min_rent'] ?? '',
    'max_rent' => $_GET['max_rent'] ?? ''
];

$properties = getProperties($filters);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties - Urban Elegance</title>
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

    <!-- Search Form -->
    <section class="search-form">
        <form method="GET">
            <div class="form-row">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" placeholder="Enter city name" value="<?php echo htmlspecialchars($filters['city']); ?>">
                </div>
                <div class="form-group">
                    <label for="property_type">Property Type</label>
                    <select id="property_type" name="property_type">
                        <option value="">All Types</option>
                        <option value="apartment" <?php echo $filters['property_type'] === 'apartment' ? 'selected' : ''; ?>>Apartment</option>
                        <option value="house" <?php echo $filters['property_type'] === 'house' ? 'selected' : ''; ?>>House</option>
                        <option value="villa" <?php echo $filters['property_type'] === 'villa' ? 'selected' : ''; ?>>Villa</option>
                        <option value="studio" <?php echo $filters['property_type'] === 'studio' ? 'selected' : ''; ?>>Studio</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="min_rent">Min Rent</label>
                    <input type="number" id="min_rent" name="min_rent" placeholder="Minimum rent" value="<?php echo htmlspecialchars($filters['min_rent']); ?>">
                </div>
                <div class="form-group">
                    <label for="max_rent">Max Rent</label>
                    <input type="number" id="max_rent" name="max_rent" placeholder="Maximum rent" value="<?php echo htmlspecialchars($filters['max_rent']); ?>">
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Search Properties</button>
                </div>
            </div>
        </form>
    </section>

    <!-- Properties Results -->
    <section style="padding: 2rem 0;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h2>Available Properties</h2>
            <p>Found <?php echo count($properties); ?> properties</p>
        </div>
        
        <?php if (empty($properties)): ?>
            <div style="text-align: center; padding: 3rem;">
                <h3>No properties found</h3>
                <p>Try adjusting your search criteria</p>
                <a href="properties.php" class="btn btn-primary">View All Properties</a>
            </div>
        <?php else: ?>
            <div class="properties-grid">
                <?php foreach ($properties as $property): ?>
                    <div class="property-card">
                        <div class="property-image">
                            <?php if ($property['images']): ?>
                                <?php $images = json_decode($property['images'], true); ?>
                                <img src="uploads/<?php echo $images[0]; ?>" alt="<?php echo htmlspecialchars($property['title']); ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                                No Image Available
                            <?php endif; ?>
                        </div>
                        <div class="property-details">
                            <div class="property-title"><?php echo htmlspecialchars($property['title']); ?></div>
                            <div class="property-price">₹<?php echo number_format($property['rent_amount']); ?>/month</div>
                            <div class="property-info">
                                <span><?php echo $property['bedrooms']; ?> BHK</span>
                                <span><?php echo $property['area_sqft']; ?> sq ft</span>
                                <span><?php echo ucfirst($property['property_type']); ?></span>
                            </div>
                            <div class="property-location"><?php echo htmlspecialchars($property['city'] . ', ' . $property['state']); ?></div>
                            <div style="margin-top: 1rem;">
                                <a href="property_details.php?id=<?php echo $property['id']; ?>" class="btn btn-primary">View Details</a>
                                <?php if (isLoggedIn() && hasRole('tenant')): ?>
                                    <a href="send_inquiry.php?id=<?php echo $property['id']; ?>" class="btn btn-secondary" style="margin-left: 0.5rem;">Contact Owner</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer style="background: #333; color: white; text-align: center; padding: 2rem 0; margin-top: 3rem;">
        <p>&copy; 2024 Urban Elegance. All rights reserved.</p>
    </footer>
</body>
</html>