# Event Booking System - Complete Setup Guide

## 📋 Project Overview

This is a professional Laravel-based Event Booking System with a beautiful Bootstrap UI. It allows users to create, manage, and book event seats with full authentication, real-time availability tracking, and email notifications.

### ✨ Features

1. **User Authentication**
   - Secure registration and login
   - Email verification
   - Password reset functionality
   - User profile management

2. **Event Management**
   - Create, read, update, delete (CRUD) events
   - Event filtering by location and date
   - Real-time seat availability tracking
   - Event details with organizer information

3. **Booking System**
   - Book seats for events
   - AJAX-based booking (no page reload)
   - Automatic seat availability updates
   - Booking history and management
   - Cancel bookings with seat release

4. **Email Notifications**
   - Confirmation emails for bookings
   - Professional HTML email templates

5. **Responsive UI**
   - Bootstrap 5 framework
   - Mobile-friendly design
   - Modern gradient styling
   - Interactive components

---

## 🚀 Installation & Setup

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL or MariaDB
- Node.js (for Vite, optional)

### Step 1: Clone the Repository

```bash
cd d:\event-booking
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies (optional)
npm install
```

### Step 3: Environment Configuration

The `.env` file is already configured, but here are the key settings:

```env
APP_NAME="Event Booking System"
APP_URL=http://localhost:8000
DB_DATABASE=event_booking
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@eventbooking.com"
MAIL_FROM_NAME="Event Booking System"
```

### Step 4: Database Setup

```bash
# Run migrations to create tables
php artisan migrate

# Seed sample data (creates users and events)
php artisan db:seed
```

### Step 5: Generate Application Key (if not already done)

```bash
php artisan key:generate
```

---

## 🔑 Test Credentials

After running the seeder, you can login with:

### Test User (Attendee)
- **Email:** test@example.com
- **Password:** password

### Organizer User
- **Email:** organizer@example.com
- **Password:** password

### Admin User
- **Email:** admin@example.com
- **Password:** password

---

## 🌐 Running the Application

### Method 1: Using PHP Built-in Server

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

### Method 2: Using Vite (Development)

In one terminal:
```bash
php artisan serve
```

In another terminal:
```bash
npm run dev
```

---

## 📁 Project Structure

```
event-booking/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── EventController.php      # Event CRUD operations
│   │   │   ├── BookingController.php    # Booking logic
│   │   │   └── ProfileController.php    # User profile
│   │   ├── Requests/
│   │   │   ├── StoreEventRequest.php    # Event validation
│   │   │   └── StoreBookingRequest.php  # Booking validation
│   │   └── Middleware/
│   ├── Mail/
│   │   └── BookingMail.php              # Booking email class
│   ├── Models/
│   │   ├── User.php
│   │   ├── Event.php
│   │   └── Booking.php
│   └── Policies/
│       └── EventPolicy.php              # Authorization policies
│
├── database/
│   ├── migrations/
│   │   ├── create_events_table.php
│   │   └── create_bookings_table.php
│   └── seeders/
│       └── DatabaseSeeder.php           # Sample data
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php            # Main layout with Bootstrap
│       │   └── navigation.blade.php     # Navigation bar
│       ├── events/
│       │   ├── index.blade.php          # Events list page
│       │   ├── create.blade.php         # Create event form
│       │   ├── edit.blade.php           # Edit event form
│       │   └── show.blade.php           # Event details page
│       ├── bookings/
│       │   └── index.blade.php          # User's bookings page
│       └── emails/
│           └── booking.blade.php        # Booking confirmation email
│
└── routes/
    └── web.php                          # Application routes
```

---

## 📚 Database Schema

### Users Table
```sql
- id
- name
- email
- email_verified_at
- password
- timestamps
```

### Events Table
```sql
- id
- title (required)
- description (optional)
- location (required)
- event_datetime (required)
- total_seats (required)
- available_seats (automatically managed)
- user_id (foreign key)
- timestamps
```

### Bookings Table
```sql
- id
- user_id (foreign key)
- event_id (foreign key)
- seats (number of seats)
- status (booked/cancelled)
- booking_date
- timestamps
```

---

## 🔄 API Endpoints / Routes

### Public Routes
- `GET /` → Redirects to events list
- `GET /events` → View all events
- `GET /events/{id}` → View event details
- `GET /login` → Login page
- `GET /register` → Registration page

### Authenticated Routes

**Events Management:**
- `GET /events/create` → Create event form
- `POST /events` → Store new event
- `GET /events/{id}/edit` → Edit event form
- `PATCH /events/{id}` → Update event
- `DELETE /events/{id}` → Delete event

**Bookings:**
- `GET /bookings` → View user's bookings
- `POST /bookings` → Create booking (AJAX)
- `GET /bookings/{id}/cancel` → Cancel booking

**Profile:**
- `GET /profile` → Edit profile
- `PATCH /profile` → Update profile
- `DELETE /profile` → Delete account

---

## ✅ Key Features Explained

### 1. Event Filtering
Users can filter events by:
- **Location** - Search by event location
- **Date** - Filter by specific date

### 2. Real-time Seat Management
- Available seats update automatically
- Cannot book more seats than available
- Booked seats returned when booking is cancelled

### 3. AJAX Booking
The event details page uses AJAX for booking without page reload:
```javascript
fetch('/bookings', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
        event_id: eventId,
        seats: numberOfSeats
    })
})
```

### 4. Authorization
- Only authenticated users can create events
- Only event creators can edit/delete their events
- Users can only view their own bookings
- Policies are defined in `EventPolicy.php`

### 5. Email Notifications
- Booking confirmations sent automatically
- Professional HTML email template
- Currently uses log driver (check `storage/logs/laravel.log`)

---

## 🎨 UI Components

The application uses Bootstrap 5 with custom styling:

### Color Scheme
- **Primary:** Purple (#6f42c1)
- **Secondary:** Blue (#0d6efd)
- **Success:** Green (#28a745)
- **Danger:** Red (#dc3545)
- **Warning:** Yellow (#ffc107)

### Features
- Responsive grid layout
- Card-based design with hover effects
- Icon integration (Bootstrap Icons)
- Smooth animations and transitions
- Modal dialogs for confirmations
- Progress bars for seat availability
- Pagination for listings

---

## 🧪 Testing the System

### Test Workflow

1. **Register/Login**
   - Go to the home page
   - Click "Register" or "Login"
   - Use test credentials provided above

2. **Create an Event**
   - Click "Create Event"
   - Fill in event details
   - Click "Create Event"

3. **View Events**
   - Go to "Browse Events"
   - Filter by location or date if needed
   - Click "View Details" on any event

4. **Book Seats**
   - On event details page
   - Enter number of seats
   - Click "Book Now"
   - Check email log for confirmation

5. **Manage Bookings**
   - Click "My Bookings"
   - View all your bookings
   - Cancel bookings if needed

6. **Edit/Delete Events**
   - Go to "Browse Events"
   - Click "Edit" or "Delete" on your events
   - Only visible for events you created

---

## 📧 Email Configuration

### Current Setup (Testing)
The system is configured to use the **log** driver for emails, which logs all emails to:
```
storage/logs/laravel.log
```

### For Production (SMTP)
Update `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=noreply@eventbooking.com
```

---

## 🔒 Security Features

1. **CSRF Protection** - All forms protected with CSRF tokens
2. **SQL Injection Prevention** - Using Eloquent ORM
3. **Password Hashing** - bcrypt with BCRYPT_ROUNDS=12
4. **Authorization** - Policies enforce ownership rules
5. **Input Validation** - Request classes validate all input
6. **Email Verification** - Users must verify emails

---

## 🐛 Troubleshooting

### Database Connection Error
```bash
# Re-run migrations
php artisan migrate:refresh --seed
```

### Session/Auth Not Working
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Email Not Sending
```bash
# Check log file
tail -f storage/logs/laravel.log

# Or use Mailtrap/Mailgun for testing
```

### Routes Not Found (404)
```bash
# Clear route cache
php artisan route:clear

# Make sure migrations ran
php artisan migrate
```

---

## 📝 Validation Rules

### Event Creation/Update
- **Title:** Required, string, max 255 characters
- **Location:** Required, string, max 255 characters
- **Event Date & Time:** Required, must be in future
- **Total Seats:** Required, integer, min 1, max 10000
- **Description:** Optional, string

### Booking
- **Event ID:** Required, must exist in events table
- **Seats:** Required, integer, min 1, max available seats

---

## 🚴 Next Steps (Optional Enhancements)

1. **Payment Integration** - Add Stripe/PayPal for paid events
2. **Search Full Text** - Advanced event search
3. **Ratings & Reviews** - Event and organizer ratings
4. **Multi-language Support** - Localization
5. **Admin Dashboard** - Analytics and reporting
6. **Notification System** - In-app notifications
7. **Event Categories** - Organize events by type
8. **Wishlist** - Save favorite events
9. **Bulk Email** - Send updates to attendees
10. **PDF Tickets** - Generate downloadable tickets

---

## 📞 Support

For issues or questions:
1. Check the Laravel documentation: https://laravel.com/docs
2. Check Bootstrap documentation: https://getbootstrap.com/docs
3. Review the code comments in the controllers and views
4. Check the `storage/logs/laravel.log` for error messages

---

## 📄 License

This project is created for educational purposes.

---

## 🎯 Quick Command Reference

```bash
# Migrations
php artisan migrate                    # Run all migrations
php artisan migrate:rollback          # Rollback last batch
php artisan migrate:refresh           # Rollback and re-run all
php artisan migrate:refresh --seed    # Migrations + seeding

# Database
php artisan db:seed                   # Seed database

# Cache/Config
php artisan cache:clear               # Clear cache
php artisan config:clear              # Clear config cache
php artisan route:clear               # Clear route cache

# Development
php artisan serve                     # Start dev server
php artisan tinker                    # Interactive shell
php artisan make:migration             # Create migration
php artisan make:model ModelName      # Create model
php artisan make:controller ControllerName # Create controller

# Debugging
php artisan optimize                  # Optimize application
tail -f storage/logs/laravel.log      # View logs
```

---

**Happy Coding! 🚀**

## Version
- Laravel: 11.x
- PHP: 8.1+
- Bootstrap: 5.3
- Database: MySQL/MariaDB

Last Updated: April 2026
