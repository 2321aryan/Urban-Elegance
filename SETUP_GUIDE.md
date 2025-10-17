# 🏠 Urban Elegance - Complete Setup Guide

## 🚀 Quick Start (3 Easy Steps)

### Option 1: Full Website with Database
```bash
1. Double-click: launch_urban_elegance.bat
2. Wait for setup to complete (30 seconds)
3. Website opens automatically in browser
```

### Option 2: Quick Test (Static Pages Only)
```bash
1. Double-click: test_website.bat
2. Browse the beautiful UI and pages
3. No database required
```

## 🔧 Manual Setup (If Needed)

### Step 1: Start XAMPP Services
1. Open XAMPP Control Panel
2. Start **Apache** service
3. Start **MySQL** service

### Step 2: Setup Database
```bash
# Run this command in terminal:
C:\xampp\php\php.exe setup_complete_database.php
```

### Step 3: Start Website
```bash
# Run PHP server:
C:\xampp\php\php.exe -S localhost:8000

# Open browser:
http://localhost:8000
```

## 🔑 Login Credentials

| Role | Email | Password |
|------|-------|----------|
| **Admin** | admin@urbanelegance.com | password |
| **Owner** | john@example.com | password123 |
| **Tenant** | jane@example.com | password123 |

## 📱 Website Features

### ✅ Complete Pages
- **Homepage** - Hero section, search, featured properties
- **Properties** - Browse with filters, detailed views
- **About Us** - Company info, team, mission
- **Contact** - Contact form, FAQ, business info
- **Login/Register** - Secure authentication
- **Dashboards** - Admin, Owner, Tenant panels
- **Payment System** - UPI, Cards, Net Banking

### ✅ User Roles
- **Admin**: Manage platform, approve properties
- **Owner**: Add properties, manage inquiries
- **Tenant**: Browse, inquire, make payments

### ✅ Technical Features
- **Responsive Design** - Works on all devices
- **Secure Backend** - PHP with MySQL
- **Payment Integration** - Multiple payment methods
- **Image Upload** - Property photos
- **Search & Filters** - Advanced property search
- **Real-time Updates** - Dynamic content loading

## 🗄️ Database Structure

### Tables Created:
- **users** - User accounts and roles
- **properties** - Property listings
- **inquiries** - Tenant-owner communication
- **payments** - Payment transactions

### Sample Data:
- **5 Users** (1 admin, 2 owners, 2 tenants)
- **6 Properties** (5 approved, 1 pending)
- **3 Inquiries** (sample communications)

## 🌐 URL Structure

| Page | URL | Description |
|------|-----|-------------|
| Homepage | `/index.html` | Main landing page |
| Properties | `/properties.php` | Property listings |
| Property Details | `/property_details.php?id=1` | Individual property |
| Login | `/login.html` | User authentication |
| Register | `/register.html` | New user signup |
| About | `/about.html` | Company information |
| Contact | `/contact.html` | Contact form |
| Admin Dashboard | `/Admin_Dashboard.php` | Admin panel |
| Owner Dashboard | `/dashboard/owner_dashboard.php` | Owner panel |
| User Dashboard | `/dashboard/user_dashboard.php` | Tenant panel |
| Add Property | `/dashboard/add_property.php` | Add new property |
| Payment | `/payment.php?property_id=1&type=rent` | Payment page |

## 🛠️ Troubleshooting

### Issue: Database Connection Error
**Solution:**
1. Start XAMPP MySQL service
2. Run `setup_complete_database.php`
3. Check database credentials in `includes/config.php`

### Issue: PHP Server Not Starting
**Solution:**
1. Check if port 8000 is free
2. Use different port: `php -S localhost:8080`
3. Ensure XAMPP PHP is in PATH

### Issue: Images Not Loading
**Solution:**
1. Check `uploads/` folder exists
2. Verify file permissions
3. Use sample images from Unsplash (already configured)

### Issue: Login Not Working
**Solution:**
1. Ensure database is setup
2. Check browser console for errors
3. Verify credentials from setup guide

## 📊 Project Statistics

- **Total Files**: 25+ PHP, HTML, CSS, JS files
- **Lines of Code**: 3000+ lines
- **Features**: 15+ major features
- **Pages**: 10+ complete pages
- **Database Tables**: 4 tables with relationships
- **Payment Methods**: 4 different options
- **User Roles**: 3 distinct roles

## 🎯 Next Steps

### For Development:
1. Customize CSS in `css/style.css`
2. Add more properties via admin panel
3. Configure email notifications
4. Add Google Maps integration
5. Implement chat system

### For Production:
1. Change database credentials
2. Configure SSL certificate
3. Setup proper hosting
4. Add backup system
5. Configure email server

## 📞 Support

If you encounter any issues:
1. Check this setup guide
2. Verify XAMPP is running
3. Check browser console for errors
4. Ensure all files are in correct locations

---

**Urban Elegance** - Your complete real estate rental platform! 🏠✨