@echo off
title Urban Elegance - Quick Test
color 0A
echo.
echo  🏠 URBAN ELEGANCE - QUICK TEST
echo  =============================
echo.
echo [1] Starting PHP Development Server...
cd /d "%~dp0"
start /min cmd /c "C:\xampp\php\php.exe -S localhost:8000"
echo     ✅ PHP server started

echo [2] Waiting for server to start...
timeout /t 3 /nobreak >nul

echo [3] Opening website...
start http://localhost:8000/index.html
echo     ✅ Website opened

echo.
echo  🌐 Website is running at: http://localhost:8000
echo  📱 You can browse the static pages and UI
echo  💡 For full functionality, run: launch_urban_elegance.bat
echo.
echo  Press any key to stop the server...
pause >nul
taskkill /f /im php.exe >nul 2>&1
echo  Server stopped.