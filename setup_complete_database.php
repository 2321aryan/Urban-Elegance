<?php
// Complete database setup with sample data
echo "🏠 Setting up Urban Elegance Complete Database...\n";

$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Connect to MySQL server
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connected to MySQL server successfully!\n";
    
    // Read and execute SQL file
    $sql = file_get_contents('database/urban_elegance.sql');
    
    // Split SQL into individual statements
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $pdo->exec($statement);
        }
    }
    
    echo "✅ Database schema created successfully!\n";
    
    // Connect to the new database
    $pdo = new PDO("mysql:host=$host;dbname=urban_elegance_db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Insert sample users
    $users = [
        ['admin', 'admin@urbanelegance.com', password_hash('password', PASSWORD_DEFAULT), 'System Administrator', '9876543210', 'admin'],
        ['john_owner', 'john@example.com', password_hash('password123', PASSWORD_DEFAULT), 'John Smith', '9876543211', 'owner'],
        ['jane_tenant', 'jane@example.com', password_hash('password123', PASSWORD_DEFAULT), 'Jane Doe', '9876543212', 'tenant'],
        ['mike_owner', 'mike@example.com', password_hash('password123', PASSWORD_DEFAULT), 'Mike Johnson', '9876543213', 'owner'],
        ['sara_tenant', 'sara@example.com', password_hash('password123', PASSWORD_DEFAULT), 'Sara Wilson', '9876543214', 'tenant']
    ];
    
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, full_name, phone, role) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($users as $user) {
        $stmt->execute($user);
    }
    echo "✅ Sample users created successfully!\n";
    
    // Insert sample properties
    $properties = [
        [2, 'Modern 3BHK Apartment in Bandra', 'Spacious apartment with modern amenities, close to railway station and shopping centers.', 'apartment', '123 Bandra West, Near Station', 'Mumbai', 'Maharashtra', '400050', 25000, 50000, 1200, 3, 2, 'semi-furnished', 1, '["sample1.jpg","sample2.jpg"]', 'approved'],
        [2, 'Luxury Villa with Garden', 'Beautiful villa with private garden, swimming pool, and premium fittings.', 'villa', '456 Koramangala, Electronic City', 'Bangalore', 'Karnataka', '560095', 45000, 90000, 2500, 4, 3, 'furnished', 1, '["sample3.jpg","sample4.jpg"]', 'approved'],
        [4, 'Cozy 2BHK Studio Apartment', 'Perfect for young professionals, fully furnished with all modern amenities.', 'studio', '789 Hinjewadi Phase 1', 'Pune', 'Maharashtra', '411057', 18000, 36000, 800, 2, 1, 'furnished', 0, '["sample5.jpg"]', 'approved'],
        [4, 'Spacious Family House', 'Independent house perfect for families, with parking and garden space.', 'house', '321 Sector 15, Dwarka', 'Delhi', 'Delhi', '110075', 35000, 70000, 1800, 3, 2, 'unfurnished', 1, '["sample6.jpg","sample7.jpg"]', 'approved'],
        [2, 'Premium Penthouse', 'Luxury penthouse with city views, premium amenities and rooftop access.', 'apartment', '654 Golf Course Road', 'Gurgaon', 'Haryana', '122002', 65000, 130000, 3000, 4, 4, 'furnished', 1, '["sample8.jpg"]', 'approved'],
        [4, 'Charming 1BHK Flat', 'Compact and well-designed apartment, perfect for singles or couples.', 'apartment', '987 Anna Nagar', 'Chennai', 'Tamil Nadu', '600040', 15000, 30000, 600, 1, 1, 'semi-furnished', 0, '["sample9.jpg"]', 'pending']
    ];
    
    $stmt = $pdo->prepare("INSERT INTO properties (owner_id, title, description, property_type, address, city, state, pincode, rent_amount, deposit_amount, area_sqft, bedrooms, bathrooms, furnished, parking, images, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($properties as $property) {
        $stmt->execute($property);
    }
    echo "✅ Sample properties created successfully!\n";
    
    // Insert sample inquiries
    $inquiries = [
        [1, 3, 2, 'Hi, I am interested in this apartment. Can we schedule a viewing?'],
        [2, 5, 4, 'This villa looks perfect for my family. What are the lease terms?'],
        [3, 3, 4, 'Is this studio apartment available immediately? I need to move in next week.']
    ];
    
    $stmt = $pdo->prepare("INSERT INTO inquiries (property_id, tenant_id, owner_id, message) VALUES (?, ?, ?, ?)");
    foreach ($inquiries as $inquiry) {
        $stmt->execute($inquiry);
    }
    echo "✅ Sample inquiries created successfully!\n";
    
    echo "\n🎉 URBAN ELEGANCE DATABASE SETUP COMPLETE!\n";
    echo "==========================================\n";
    echo "🔑 Login Credentials:\n";
    echo "   Admin: admin@urbanelegance.com / password\n";
    echo "   Owner: john@example.com / password123\n";
    echo "   Tenant: jane@example.com / password123\n";
    echo "\n📊 Database Statistics:\n";
    echo "   Users: " . count($users) . " (1 admin, 2 owners, 2 tenants)\n";
    echo "   Properties: " . count($properties) . " (5 approved, 1 pending)\n";
    echo "   Inquiries: " . count($inquiries) . "\n";
    echo "\n🌐 Access your website at: http://localhost:8000\n";
    
} catch (PDOException $e) {
    echo "❌ Database setup failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>