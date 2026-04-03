@component('mail::message')
# Booking Confirmation

Hello {{ $booking->user->name }},

Thank you for booking with us! Your event booking has been confirmed.

**Booking Details:**

@component('mail::panel')
| | |
|---|---|
| **Event** | {{ $booking->event->title }} |
| **Location** | {{ $booking->event->location }} |
| **Date & Time** | {{ $booking->event->event_datetime->format('F d, Y - g:i A') }} |
| **Seats Booked** | {{ $booking->seats }} |
| **Booking Date** | {{ $booking->booking_date->format('F d, Y') }} |
| **Booking ID** | #{{ $booking->id }} |
@endcomponent

**Event Description:**

{{ $booking->event->description }}

@component('mail::button', ['url' => route('events.show', $booking->event), 'color' => 'primary'])
View Event Details
@endcomponent

@component('mail::panel')
**Important Information:**
- Please arrive 15 minutes before the event starts
- Keep this confirmation email for reference
- You can manage your bookings in your account dashboard
- To cancel this booking, visit your bookings page
@endcomponent

If you have any questions or need assistance, please don't hesitate to contact us.

Thanks,<br>
{{ config('app.name') }}

@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
@endcomponent
@endslot
@endcomponent