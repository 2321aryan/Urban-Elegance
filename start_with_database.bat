@echo off
title Urban Elegance - Starting Services
color 0A
echo.
echo  🏠 URBAN ELEGANCE - REAL ESTATE PLATFORM
echo  ==========================================
echo.
echo [1] Starting MySQL Database...
start /min "" "C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:\xampp\mysql\bin\my.ini" --standalone --console
echo [2] Waiting for MySQL to initialize...
timeout /t 5 /nobreak >nul

echo [3] Starting PHP Development Server...
cd /d "%~dp0"
start /min cmd /c "C:\xampp\php\php.exe -S localhost:8000"
echo [4] Waiting for server to start...
timeout /t 3 /nobreak >nul

echo [5] Setting up database (if needed)...
C:\xampp\php\php.exe setup_database.php

echo [6] Opening Urban Elegance website...
start http://localhost:8000/index.html
echo.
echo ✅ Urban Elegance is now running with database!
echo 🌐 Website: http://localhost:8000
echo 💾 Database: MySQL running
echo.
echo Press any key to stop all services...
pause >nul
echo Stopping services...
taskkill /f /im php.exe >nul 2>&1
taskkill /f /im mysqld.exe >nul 2>&1
echo Services stopped. Goodbye!