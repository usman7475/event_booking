@echo off
REM Event Booking System - Windows Quick Commands

:menu
cls
echo.
echo ========================================
echo    Event Booking System - Quick Menu
echo ========================================
echo.
echo Select an option:
echo.
echo 1. START SERVER (http://localhost:8000)
echo 2. Fresh Database Setup (Migrations + Seed)
echo 3. Clear Cache
echo 4. View Help Documentation
echo 5. Run Tinker (Database Shell)
echo 6. Exit
echo.
set /p choice="Enter your choice (1-6): "

if "%choice%"=="1" goto start_server
if "%choice%"=="2" goto fresh_db
if "%choice%"=="3" goto clear_cache
if "%choice%"=="4" goto help_docs
if "%choice%"=="5" goto tinker
if "%choice%"=="6" goto exit

echo Invalid choice. Please try again.
pause
goto menu

:start_server
echo.
echo Starting server at http://localhost:8000
echo.
echo Press Ctrl+C to stop the server
echo.
cd /d d:\event-booking
php artisan serve
pause
goto menu

:fresh_db
echo.
echo Refreshing database with fresh migrations and seed data...
echo.
cd /d d:\event-booking
php artisan migrate:refresh --seed
echo.
echo Database refresh complete!
echo.
pause
goto menu

:clear_cache
echo.
echo Clearing cache...
echo.
cd /d d:\event-booking
php artisan cache:clear
php artisan config:clear
php artisan route:clear
echo.
echo Cache cleared successfully!
echo.
pause
goto menu

:help_docs
cls
echo.
echo ========================================
echo    Event Booking System - Help & URLs
echo ========================================
echo.
echo GETTING STARTED:
echo ================
echo 1. Select option 1 to start the server
echo 2. Open http://localhost:8000 in your browser
echo 3. Login with any of these test accounts:
echo.
echo TEST ACCOUNTS:
echo ==============
echo Email: test@example.com
echo Password: password
echo.
echo Email: organizer@example.com
echo Password: password
echo.
echo Email: admin@example.com
echo Password: password
echo.
echo KEY URLS:
echo =========
echo Home/Events:     http://localhost:8000
echo Create Event:    http://localhost:8000/events/create
echo My Bookings:     http://localhost:8000/bookings
echo Profile:         http://localhost:8000/profile
echo Login:           http://localhost:8000/login
echo Register:        http://localhost:8000/register
echo.
echo DOCUMENTATION:
echo ===============
echo - README_COMPLETE.md          (Quick Start Guide)
echo - PROJECT_COMPLETION_SUMMARY.md (Everything Done)
echo - SETUP_GUIDE.md              (Detailed Setup)
echo - QUICK_REFERENCE.md          (Quick Reference)
echo.
echo DOCUMENTATION FILES:
echo ====================
echo Documentation is saved in your project folder!
echo.
pause
goto menu

:tinker
echo.
echo Starting Tinker shell...
echo.
echo Usage examples:
echo   User::all()
echo   Event::all()
echo   Booking::all()
echo   Event::count()
echo.
cd /d d:\event-booking
php artisan tinker
pause
goto menu

:exit
echo.
echo Thank you for using Event Booking System!
echo.
exit /b
