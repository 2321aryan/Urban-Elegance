@echo off
title Urban Elegance - Demo Mode
color 0A
cls
echo.
echo  🏠 URBAN ELEGANCE - DEMO MODE
echo  ============================
echo.
echo  🚀 Starting Urban Elegance in Demo Mode...
echo  (No database required - using sample data)
echo.

echo [1] Starting PHP Development Server...
cd /d "%~dp0"
start /min cmd /c "C:\xampp\php\php.exe -S localhost:8000"
echo     ✅ PHP server started on localhost:8000

echo [2] Waiting for server to initialize...
timeout /t 3 /nobreak >nul

echo [3] Opening Urban Elegance website...
start http://localhost:8000/index.html
echo     ✅ Website opened in browser

echo.
echo  🎉 URBAN ELEGANCE IS NOW RUNNING IN DEMO MODE!
echo  =============================================
echo.
echo  🌐 Website URL: http://localhost:8000
echo  📊 Features Available:
echo     ✅ Browse Properties (Sample Data)
echo     ✅ Property Details & Search
echo     ✅ User Interface & Design
echo     ✅ Responsive Mobile Layout
echo     ✅ About & Contact Pages
echo.
echo  🔑 Demo Login Credentials:
echo     Admin:  admin@urbanelegance.com / password
echo     Owner:  john@example.com / password123
echo     Tenant: jane@example.com / password123
echo.
echo  💡 For full functionality with database:
echo     Run: launch_urban_elegance.bat
echo.
echo  ⚠️  Press any key to stop the server...
pause >nul

echo.
echo  🛑 Stopping PHP server...
taskkill /f /im php.exe >nul 2>&1
echo  ✅ Server stopped successfully!
echo.
echo  👋 Thank you for using Urban Elegance!
timeout /t 2 /nobreak >nul