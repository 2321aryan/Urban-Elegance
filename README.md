# Urban Elegance - Real Estate Rental Website

A complete web-based house rental platform built with HTML, CSS, JavaScript, PHP, and MySQL using XAMPP.

## Features

- **User Registration & Authentication** (Admin, Owner, Tenant roles)
- **Property Management** (Add, Edit, View properties)
- **Advanced Search & Filters** (City, type, price range)
- **Inquiry System** (Direct communication between tenants and owners)
- **Admin Dashboard** (Approve/reject properties, manage users)
- **Responsive Design** (Works on desktop and mobile)
- **Image Upload** (Multiple property images)
- **Secure Backend** (Password hashing, SQL injection protection)

## Installation Instructions

### Prerequisites
- XAMPP (Apache, PHP, MySQL)
- Web browser
- Text editor (VS Code recommended)

### Setup Steps

1. **Install XAMPP**
   - Download and install XAMPP from https://www.apachefriends.org/
   - Start Apache and MySQL services

2. **Setup Project**
   ```bash
   # Copy project to XAMPP htdocs folder
   C:\xampp\htdocs\urban_elegance\
   ```

3. **Create Database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Import the database file: `database/urban_elegance.sql`
   - Or run the SQL commands manually

4. **Configure Database**
   - Update database credentials in `includes/config.php` if needed
   - Default settings work with XAMPP

5. **Create Upload Directory**
   ```bash
   # Create uploads folder with write permissions
   mkdir uploads
   chmod 755 uploads
   ```

6. **Access Website**
   - Open browser and go to: `http://localhost/urban_elegance/`

## Default Admin Login
- **Email:** admin@urbanelegance.com
- **Password:** password

## Project Structure

```
urban_elegance/
├── index.html              # Homepage
├── login.html              # Login page
├── register.html           # Registration page
├── properties.php          # Property listings
├── property_details.php    # Property details page
├── send_inquiry.php        # Send inquiry form
├── css/
│   └── style.css          # Main stylesheet
├── js/
│   └── script.js          # JavaScript functions
├── includes/
│   ├── config.php         # Database configuration
│   └── functions.php      # Helper functions
├── auth/
│   ├── login.php          # Login processing
│   ├── register.php       # Registration processing
│   └── logout.php         # Logout processing
├── dashboard/
│   ├── admin_dashboard.php    # Admin dashboard
│   ├── owner_dashboard.php    # Owner dashboard
│   ├── user_dashboard.php     # User dashboard
│   └── add_property.php       # Add property form
├── api/
│   └── get_properties.php     # API for property data
├── database/
│   └── urban_elegance.sql     # Database schema
└── uploads/                   # Property images
```

## User Roles

### Admin
- Approve/reject property listings
- Manage users
- View system statistics
- Monitor inquiries

### Owner/Agent
- Add new properties
- Edit existing properties
- View property inquiries
- Manage property status

### Tenant/User
- Search and filter properties
- View property details
- Send inquiries to owners
- Track inquiry status

## Key Features Explained

### Authentication System
- Secure password hashing using PHP's `password_hash()`
- Session management
- Role-based access control

### Property Management
- Multiple image upload
- Rich property details (bedrooms, bathrooms, area, etc.)
- Status management (pending, approved, rejected)
- Search and filtering capabilities

### Inquiry System
- Direct communication between tenants and owners
- Inquiry tracking and status updates
- Email notifications (can be extended)

### Admin Controls
- Property approval workflow
- User management
- System statistics dashboard

## Security Features

- SQL injection prevention using prepared statements
- XSS protection with input sanitization
- CSRF protection (can be enhanced)
- File upload validation
- Session security

## Customization

### Adding New Features
1. **Payment Integration:** Add payment gateway for booking
2. **Chat System:** Real-time messaging between users
3. **Email Notifications:** Automated email alerts
4. **Google Maps:** Location mapping for properties
5. **Reviews & Ratings:** Property review system

### Styling
- Modify `css/style.css` for custom styling
- Responsive design already implemented
- Easy to customize color scheme and layout

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check XAMPP MySQL service is running
   - Verify database credentials in `config.php`

2. **Image Upload Issues**
   - Ensure `uploads/` folder exists and has write permissions
   - Check PHP file upload settings in `php.ini`

3. **Login Issues**
   - Clear browser cache and cookies
   - Check database for user records

4. **Page Not Found**
   - Ensure all files are in correct directory structure
   - Check Apache service is running

## Development Notes

- Built with modern PHP practices
- Uses PDO for database operations
- Responsive CSS Grid and Flexbox layout
- Vanilla JavaScript (no frameworks)
- Clean, semantic HTML structure

## Future Enhancements

- Mobile app version
- Advanced search filters
- Property comparison feature
- Saved searches and favorites
- Social media integration
- Multi-language support

## Support

For issues or questions:
1. Check the troubleshooting section
2. Review the code comments
3. Test with default admin account
4. Verify XAMPP configuration

---

**Urban Elegance** - Connecting property owners and tenants directly, without broker fees.