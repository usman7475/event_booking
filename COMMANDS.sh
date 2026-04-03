#!/bin/bash

# Event Booking System - Quick Commands Reference

# 🚀 START THE APPLICATION
echo "Starting Event Booking System..."
cd d:\event-booking
php artisan serve

# 📍 APPLICATION URL
# http://localhost:8000

# 🔐 TEST LOGIN CREDENTIALS
# test@example.com / password
# organizer@example.com / password
# admin@example.com / password

# 🌐 KEY URLS

# PUBLIC PAGES (No login required)
echo ""
echo "PUBLIC PAGES:"
echo "✓ Home/Events List: http://localhost:8000"
echo "✓ Event Details: http://localhost:8000/events/{id}"
echo "✓ Login: http://localhost:8000/login"
echo "✓ Register: http://localhost:8000/register"

# AUTHENTICATED PAGES (Login required)
echo ""
echo "AUTHENTICATED PAGES:"
echo "✓ Create Event: http://localhost:8000/events/create"
echo "✓ Edit Event: http://localhost:8000/events/{id}/edit"
echo "✓ My Bookings: http://localhost:8000/bookings"
echo "✓ Profile: http://localhost:8000/profile"

# ⚙️ ARTISAN COMMANDS

echo ""
echo "USEFUL ARTISAN COMMANDS:"
echo ""
echo "Migrations & Database:"
echo "  php artisan migrate              - Run all migrations"
echo "  php artisan migrate:refresh --seed - Fresh migrations + seed"
echo "  php artisan db:seed              - Seed database"
echo ""
echo "Cache & Routes:"
echo "  php artisan cache:clear          - Clear cache"
echo "  php artisan route:clear          - Clear route cache"
echo "  php artisan config:clear         - Clear config cache"
echo ""
echo "Development:"
echo "  php artisan serve                - Start dev server"
echo "  php artisan tinker               - Interactive shell"
echo "  php artisan optimize             - Optimize app"
echo ""
echo "Table Data (in tinker):"
echo "  User::all()                      - See all users"
echo "  Event::all()                     - See all events"
echo "  Booking::all()                   - See all bookings"
echo ""

# 📧 EMAIL TESTING
echo "EMAIL TESTING:"
echo "  Check: storage/logs/laravel.log"
echo "  Look for: 'Booking confirmation'"
echo ""

# 🔄 WORKFLOW
echo "TESTING WORKFLOW:"
echo ""
echo "1. Start server:"
echo "   php artisan serve"
echo ""
echo "2. Open in browser:"
echo "   http://localhost:8000"
echo ""
echo "3. Login with test account:"
echo "   Email: test@example.com"
echo "   Password: password"
echo ""
echo "4. Books seats for an event"
echo ""
echo "5. Check your bookings:"
echo "   http://localhost:8000/bookings"
echo ""
echo "6. View confirmation email:"
echo "   Check storage/logs/laravel.log"
echo ""
