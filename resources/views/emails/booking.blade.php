<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #6f42c1 0%, #0d6efd 100%); color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { background: #f8f9fa; padding: 20px; }
        .details { background: white; padding: 15px; margin: 15px 0; border-left: 4px solid #6f42c1; }
        .details p { margin: 8px 0; }
        .label { font-weight: bold; color: #6f42c1; }
        .button { display: inline-block; background: #6f42c1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 15px 0; }
        .footer { background: #2c3e50; color: white; padding: 15px; text-align: center; font-size: 12px; }
        .warning { background: #fff3cd; padding: 10px; margin: 15px 0; border-left: 4px solid #ffc107; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1> Booking Confirmed!</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello <strong>{{ $booking->user->name }}</strong>,</p>
            
            <p>Thank you for booking with us! Your event booking has been confirmed. 🎉</p>

            <!-- Booking Details -->
            <div class="details">
                <h2 style="margin-top: 0; color: #6f42c1;"> Booking Details</h2>
                <p>
                    <span class="label">Event:</span> {{ $booking->event->title }}<br>
                    <span class="label">Location:</span> {{ $booking->event->location }}<br>
                    <span class="label">Date & Time:</span> {{ $booking->event->event_datetime->format('F d, Y - g:i A') }}<br>
                    <span class="label">Seats Booked:</span> {{ $booking->seats }}<br>
                    <span class="label">Booking Date:</span> {{ $booking->booking_date->format('F d, Y') }}<br>
                    <span class="label">Booking ID:</span> #{{ $booking->id }}
                </p>
            </div>

            <!-- Event Description -->
            @if($booking->event->description)
            <div class="details">
                <h3 style="margin-top: 0; color: #6f42c1;"> Event Description</h3>
                <p>{{ $booking->event->description }}</p>
            </div>
            @endif

            <!-- Important Info -->
            <div class="warning">
                <h3 style="margin-top: 0;">⚠️ Important Information</h3>
                <ul>
                    <li>Please arrive 15 minutes before the event starts</li>
                    <li>Keep this confirmation email for reference</li>
                    <li>You can manage your bookings in your account dashboard</li>
                    <li>To cancel this booking, visit your bookings page</li>
                </ul>
            </div>

            <!-- View Details Button -->
            <div style="text-align: center;">
                <a href="{{ route('events.show', $booking->event) }}" class="button">View Event Details</a>
            </div>

            <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>

            <p>Thanks,<br>
            <strong>Event Booking Team</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2026 Event Booking System. All rights reserved.
        </div>
    </div>
</body>
</html>