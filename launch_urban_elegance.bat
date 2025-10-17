@echo off
title Urban Elegance - Complete Setup & Launch
color 0A
cls
echo.
echo  ██╗   ██╗██████╗ ██████╗  █████╗ ███╗   ██╗    ███████╗██╗     ███████╗ ██████╗  █████╗ ███╗   ██╗ ██████╗███████╗
echo  ██║   ██║██╔══██╗██╔══██╗██╔══██╗████╗  ██║    ██╔════╝██║     ██╔════╝██╔════╝ ██╔══██╗████╗  ██║██╔════╝██╔════╝
echo  ██║   ██║██████╔╝██████╔╝███████║██╔██╗ ██║    █████╗  ██║     █████╗  ██║  ███╗███████║██╔██╗ ██║██║     █████╗  
echo  ██║   ██║██╔══██╗██╔══██╗██╔══██║██║╚██╗██║    ██╔══╝  ██║     ██╔══╝  ██║   ██║██╔══██║██║╚██╗██║██║     ██╔══╝  
echo  ╚██████╔╝██║  ██║██████╔╝██║  ██║██║ ╚████║    ███████╗███████╗███████╗╚██████╔╝██║  ██║██║ ╚████║╚██████╗███████╗
echo   ╚═════╝ ╚═╝  ╚═╝╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═══╝    ╚══════╝╚══════╝╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═══╝ ╚═════╝╚══════╝
echo.
echo  🏠 COMPLETE REAL ESTATE RENTAL PLATFORM
echo  =======================================
echo.
echo  🚀 Starting Urban Elegance with full functionality...
echo.

echo [1/6] 🔧 Starting MySQL Database...
start /min "" "C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:\xampp\mysql\bin\my.ini" --standalone --console
echo      ✅ MySQL service started

echo [2/6] ⏳ Waiting for MySQL to initialize...
timeout /t 5 /nobreak >nul

echo [3/6] 🗄️ Setting up complete database with sample data...
C:\xampp\php\php.exe setup_complete_database.php
echo      ✅ Database setup completed

echo [4/6] 🌐 Starting PHP Development Server...
cd /d "%~dp0"
start /min cmd /c "C:\xampp\php\php.exe -S localhost:8000"
echo      ✅ PHP server started on localhost:8000

echo [5/6] ⏳ Waiting for server to initialize...
timeout /t 3 /nobreak >nul

echo [6/6] 🚀 Launching Urban Elegance in browser...
start http://localhost:8000/index.html
echo      ✅ Website launched successfully!

echo.
echo  🎉 URBAN ELEGANCE IS NOW RUNNING!
echo  ================================
echo.
echo  🌐 Website URL: http://localhost:8000
echo  📊 Admin Panel: http://localhost:8000/Admin_Dashboard.php
echo  💾 Database: MySQL running on localhost:3306
echo.
echo  🔑 LOGIN CREDENTIALS:
echo  ┌─────────────────────────────────────────┐
echo  │ Admin:  admin@urbanelegance.com         │
echo  │         password                        │
echo  │                                         │
echo  │ Owner:  john@example.com                │
echo  │         password123                     │
echo  │                                         │
echo  │ Tenant: jane@example.com                │
echo  │         password123                     │
echo  └─────────────────────────────────────────┘
echo.
echo  📱 FEATURES AVAILABLE:
echo  • ✅ User Registration & Login
echo  • ✅ Property Search & Filters
echo  • ✅ Property Management (Add/Edit)
echo  • ✅ Direct Owner-Tenant Communication
echo  • ✅ Payment System (UPI/Card/NetBanking)
echo  • ✅ Admin Dashboard & Approvals
echo  • ✅ Responsive Design (Mobile-Friendly)
echo  • ✅ Complete About & Contact Pages
echo.
echo  💡 QUICK START:
echo  1. Visit http://localhost:8000
echo  2. Register as Owner or Tenant
echo  3. Browse properties or add your own
echo  4. Use admin login to manage platform
echo.
echo  ⚠️  Press any key to stop all services and exit...
pause >nul

echo.
echo  🛑 Stopping services...
taskkill /f /im php.exe >nul 2>&1
taskkill /f /im mysqld.exe >nul 2>&1
echo  ✅ All services stopped successfully!
echo.
echo  👋 Thank you for using Urban Elegance!
timeout /t 3 /nobreak >nul