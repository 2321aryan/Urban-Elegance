<?php
// Urban Elegance Installation Verification Script
echo "🏠 URBAN ELEGANCE - INSTALLATION VERIFICATION\n";
echo "=============================================\n\n";

$errors = [];
$warnings = [];
$success = [];

// Check PHP version
echo "📋 Checking System Requirements...\n";
if (version_compare(PHP_VERSION, '7.4.0', '>=')) {
    $success[] = "✅ PHP Version: " . PHP_VERSION . " (Compatible)";
} else {
    $errors[] = "❌ PHP Version: " . PHP_VERSION . " (Requires 7.4+)";
}

// Check required extensions
$required_extensions = ['pdo', 'pdo_mysql', 'json', 'mbstring'];
foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        $success[] = "✅ PHP Extension: $ext";
    } else {
        $errors[] = "❌ Missing PHP Extension: $ext";
    }
}

// Check file structure
echo "\n📁 Checking File Structure...\n";
$required_files = [
    'index.html' => 'Homepage',
    'login.html' => 'Login Page',
    'register.html' => 'Registration Page',
    'about.html' => 'About Page',
    'contact.html' => 'Contact Page',
    'properties.php' => 'Properties Listing',
    'property_details.php' => 'Property Details',
    'payment.php' => 'Payment System',
    'Admin_Dashboard.php' => 'Admin Dashboard',
    'css/style.css' => 'Stylesheet',
    'js/script.js' => 'JavaScript',
    'includes/config.php' => 'Database Config',
    'includes/functions.php' => 'Helper Functions',
    'auth/login.php' => 'Login Handler',
    'auth/register.php' => 'Registration Handler',
    'dashboard/owner_dashboard.php' => 'Owner Dashboard',
    'dashboard/user_dashboard.php' => 'User Dashboard',
    'dashboard/add_property.php' => 'Add Property Form',
    'database/urban_elegance.sql' => 'Database Schema'
];

foreach ($required_files as $file => $description) {
    if (file_exists($file)) {
        $success[] = "✅ $description: $file";
    } else {
        $errors[] = "❌ Missing: $description ($file)";
    }
}

// Check directories
$required_dirs = ['uploads', 'css', 'js', 'includes', 'auth', 'dashboard', 'database', 'api'];
foreach ($required_dirs as $dir) {
    if (is_dir($dir)) {
        $success[] = "✅ Directory: $dir";
    } else {
        $warnings[] = "⚠️ Missing Directory: $dir";
    }
}

// Check database connection
echo "\n🗄️ Checking Database Connection...\n";
try {
    $pdo = new PDO("mysql:host=localhost", 'root', '');
    $success[] = "✅ MySQL Connection: Available";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'urban_elegance_db'");
    if ($stmt->rowCount() > 0) {
        $success[] = "✅ Database: urban_elegance_db exists";
        
        // Check tables
        $pdo->exec("USE urban_elegance_db");
        $tables = ['users', 'properties', 'inquiries', 'payments'];
        foreach ($tables as $table) {
            $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
            if ($stmt->rowCount() > 0) {
                $success[] = "✅ Table: $table";
            } else {
                $warnings[] = "⚠️ Missing Table: $table";
            }
        }
    } else {
        $warnings[] = "⚠️ Database 'urban_elegance_db' not found";
    }
} catch (Exception $e) {
    $warnings[] = "⚠️ MySQL Connection: " . $e->getMessage();
}

// Check uploads directory permissions
if (is_dir('uploads')) {
    if (is_writable('uploads')) {
        $success[] = "✅ Uploads Directory: Writable";
    } else {
        $warnings[] = "⚠️ Uploads Directory: Not writable";
    }
}

// Display results
echo "\n📊 VERIFICATION RESULTS\n";
echo "======================\n\n";

if (!empty($success)) {
    echo "✅ SUCCESS (" . count($success) . " items):\n";
    foreach ($success as $item) {
        echo "   $item\n";
    }
    echo "\n";
}

if (!empty($warnings)) {
    echo "⚠️ WARNINGS (" . count($warnings) . " items):\n";
    foreach ($warnings as $item) {
        echo "   $item\n";
    }
    echo "\n";
}

if (!empty($errors)) {
    echo "❌ ERRORS (" . count($errors) . " items):\n";
    foreach ($errors as $item) {
        echo "   $item\n";
    }
    echo "\n";
}

// Final status
echo "🎯 FINAL STATUS\n";
echo "===============\n";

if (empty($errors)) {
    if (empty($warnings)) {
        echo "🎉 PERFECT! Urban Elegance is fully installed and ready!\n";
        echo "🚀 Run: launch_urban_elegance.bat to start\n";
    } else {
        echo "✅ GOOD! Urban Elegance is installed with minor warnings.\n";
        echo "🚀 You can run: launch_urban_elegance.bat to start\n";
        echo "💡 Address warnings for full functionality.\n";
    }
} else {
    echo "❌ ISSUES FOUND! Please fix errors before running.\n";
    echo "📖 Check SETUP_GUIDE.md for solutions.\n";
}

echo "\n🌐 Access URLs:\n";
echo "   Homepage: http://localhost:8000/index.html\n";
echo "   Admin: http://localhost:8000/Admin_Dashboard.php\n";
echo "   Properties: http://localhost:8000/properties.php\n";

echo "\n🔑 Default Credentials:\n";
echo "   Admin: admin@urbanelegance.com / password\n";
echo "   Owner: john@example.com / password123\n";
echo "   Tenant: jane@example.com / password123\n";
?>