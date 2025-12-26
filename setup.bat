@echo off
echo =====================================
echo Tourist Guide Backend - Setup Script
echo =====================================
echo.

cd /d "%~dp0"

echo [1/5] Checking requirements...
php --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: PHP is not installed or not in PATH
    pause
    exit /b 1
)

composer --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: Composer is not installed or not in PATH
    pause
    exit /b 1
)

echo [OK] PHP and Composer are installed
echo.

echo [2/5] Installing Composer dependencies...
composer install --no-interaction
if errorlevel 1 (
    echo ERROR: Failed to install dependencies
    pause
    exit /b 1
)
echo [OK] Dependencies installed
echo.

echo [3/5] Checking .env file...
if not exist ".env" (
    echo .env file not found!
    echo.
    echo Please ensure .env exists with proper database credentials:
    echo   DB_CONNECTION=mysql
    echo   DB_DATABASE=tourguid_backend
    echo   DB_USERNAME=root
    echo   DB_PASSWORD=your_password
    echo.
    pause
    exit /b 1
)
echo [OK] .env file exists
echo.

echo [4/5] Running database migrations...
echo Make sure MySQL is running and database 'tourguid_backend' exists!
echo.
pause
php artisan migrate --force
if errorlevel 1 (
    echo ERROR: Migration failed
    echo.
    echo Please create the database first:
    echo   CREATE DATABASE tourguid_backend;
    echo.
    pause
    exit /b 1
)
echo [OK] Migrations completed
echo.

echo [5/5] Creating storage link...
php artisan storage:link
echo [OK] Storage link created
echo.

echo =====================================
echo Setup Complete!
echo =====================================
echo.
echo Your backend is ready to use!
echo.
echo To start the server:
echo   php artisan serve
echo.
echo API will be available at:
echo   http://localhost:8000
echo.
echo Next steps:
echo   1. Register a user at: POST http://localhost:8000/api/register
echo   2. Login to get auth token
echo   3. Use the token for protected endpoints
echo.
echo See QUICKSTART.md for more details.
echo.
pause
