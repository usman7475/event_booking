<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Http\Requests\StoreBookingRequest;
use App\Mail\BookingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
  
    /**
     * Display user's bookings
     */
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('event')->latest()->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(StoreBookingRequest $request){
        try {
            $event = Event::findOrFail($request->event_id);

            if($request->seats > $event->available_seats){
                return response()->json(['error' => 'Not enough seats available'], 422);
            }

            // Check if user already booked this event
            $existingBooking = Booking::where('user_id', auth()->id())
                                      ->where('event_id', $event->id)
                                      ->where('status', 'booked')
                                      ->first();
            
            if ($existingBooking) {
                return response()->json(['error' => 'You have already booked this event'], 422);
            }

            $booking = Booking::create([
                'user_id' => auth()->id(),
                'event_id' => $event->id,
                'seats' => $request->seats,
                'status' => 'booked',
                'booking_date' => now()
            ]);

            $event->decrement('available_seats', $request->seats);

            // Send email
            try {
                Mail::to(auth()->user()->email)
                    ->send(new BookingMail($booking));
            } catch (\Exception $e) {
                \Log::error('Email sending failed: ' . $e->getMessage());
            }

            return response()->json([
                'success' => 'Event booked successfully! Check your email for confirmation.'
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Booking error: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while processing your booking'
            ], 500);
        }
    }

    /**
     * Cancel a booking
     */
    public function cancel($id){
 $booking = Booking::where('user_id',auth()->id())->findOrFail($id);

 if($booking->status === 'cancelled'){
  return back()->with('error','Booking is already cancelled');
 }

 $booking->update(['status'=>'cancelled']);
 $booking->event->increment('available_seats',$booking->seats);

 return back()->with('success','Booking cancelled successfully!');
}
}
