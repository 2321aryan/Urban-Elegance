<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

requireLogin();
requireAdmin();

// Get statistics
$stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users WHERE role != 'admin'");
$total_users = $stmt->fetch()['total_users'];

$stmt = $pdo->query("SELECT COUNT(*) as total_properties FROM properties");
$total_properties = $stmt->fetch()['total_properties'];

$stmt = $pdo->query("SELECT COUNT(*) as pending_properties FROM properties WHERE status = 'pending'");
$pending_properties = $stmt->fetch()['pending_properties'];

$stmt = $pdo->query("SELECT COUNT(*) as total_inquiries FROM inquiries");
$total_inquiries = $stmt->fetch()['total_inquiries'];

// Handle property approval/rejection
if ($_POST['action'] ?? '' === 'update_property_status') {
    $property_id = $_POST['property_id'];
    $status = $_POST['status'];
    
    $stmt = $pdo->prepare("UPDATE properties SET status = ? WHERE id = ?");
    $stmt->execute([$status, $property_id]);
    
    header("Location: admin_dashboard.php");
    exit;
}

// Get pending properties
$stmt = $pdo->query("SELECT p.*, u.full_name as owner_name FROM properties p JOIN users u ON p.owner_id = u.id WHERE p.status = 'pending' ORDER BY p.created_at DESC");
$pending_props = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Urban Elegance</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">Urban Elegance - Admin</div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="admin_dashboard.php">Dashboard</a></li>
                    <li><a href="../auth/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="dashboard">
        <div class="dashboard-header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?>!</h1>
            <p>Admin Dashboard - Manage your platform</p>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_users; ?></div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_properties; ?></div>
                <div class="stat-label">Total Properties</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $pending_properties; ?></div>
                <div class="stat-label">Pending Approvals</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_inquiries; ?></div>
                <div class="stat-label">Total Inquiries</div>
            </div>
        </div>

        <!-- Pending Properties -->
        <div class="table-container">
            <h2 style="padding: 1rem;">Pending Property Approvals</h2>
            <?php if (empty($pending_props)): ?>
                <p style="padding: 1rem;">No pending properties for approval.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Property</th>
                            <th>Owner</th>
                            <th>Type</th>
                            <th>Rent</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pending_props as $prop): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($prop['title']); ?></td>
                            <td><?php echo htmlspecialchars($prop['owner_name']); ?></td>
                            <td><?php echo ucfirst($prop['property_type']); ?></td>
                            <td>₹<?php echo number_format($prop['rent_amount']); ?></td>
                            <td><?php echo htmlspecialchars($prop['city']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($prop['created_at'])); ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="update_property_status">
                                    <input type="hidden" name="property_id" value="<?php echo $prop['id']; ?>">
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success" style="padding: 0.3rem 0.8rem; margin-right: 0.5rem;">Approve</button>
                                </form>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="update_property_status">
                                    <input type="hidden" name="property_id" value="<?php echo $prop['id']; ?>">
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger" style="padding: 0.3rem 0.8rem;">Reject</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
