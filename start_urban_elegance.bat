@echo off
title Urban Elegance - Real Estate Website
color 0A
echo.
echo  ██╗   ██╗██████╗ ██████╗  █████╗ ███╗   ██╗    ███████╗██╗     ███████╗ ██████╗  █████╗ ███╗   ██╗ ██████╗███████╗
echo  ██║   ██║██╔══██╗██╔══██╗██╔══██╗████╗  ██║    ██╔════╝██║     ██╔════╝██╔════╝ ██╔══██╗████╗  ██║██╔════╝██╔════╝
echo  ██║   ██║██████╔╝██████╔╝███████║██╔██╗ ██║    █████╗  ██║     █████╗  ██║  ███╗███████║██╔██╗ ██║██║     █████╗  
echo  ██║   ██║██╔══██╗██╔══██╗██╔══██║██║╚██╗██║    ██╔══╝  ██║     ██╔══╝  ██║   ██║██╔══██║██║╚██╗██║██║     ██╔══╝  
echo  ╚██████╔╝██║  ██║██████╔╝██║  ██║██║ ╚████║    ███████╗███████╗███████╗╚██████╔╝██║  ██║██║ ╚████║╚██████╗███████╗
echo   ╚═════╝ ╚═╝  ╚═╝╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═══╝    ╚══════╝╚══════╝╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═══╝ ╚═════╝╚══════╝
echo.
echo  🏠 Real Estate Rental Platform
echo  ✨ Find Your Perfect Home
echo.
echo [1] Starting PHP Development Server...
cd /d "%~dp0"
start /min cmd /c "C:\xampp\php\php.exe -S localhost:8000"
echo [2] Waiting for server to start...
timeout /t 4 /nobreak >nul
echo [3] Opening Urban Elegance website...
start http://localhost:8000/index.html
echo.
echo ✅ Urban Elegance is now running!
echo 🌐 Website URL: http://localhost:8000
echo 📱 Your website is opening in the browser...
echo.
echo 💡 Features Available:
echo    - Beautiful Homepage
echo    - Property Search
echo    - User Registration/Login
echo    - Property Management
echo    - Admin Dashboard
echo.
echo ⚠️  Note: For full PHP functionality, ensure XAMPP MySQL is running
echo.
echo Press any key to stop the server and close...
pause >nul
taskkill /f /im php.exe >nul 2>&1
echo Server stopped. Goodbye!