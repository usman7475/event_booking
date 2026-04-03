@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Event Details Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">{{ $event->title }}</h2>
                        @auth
                            @if(auth()->id() === $event->user_id)
                            <div class="btn-group" role="group">
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this event?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                            @endif
                        @endauth
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <!-- Event Info Grid -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="text-muted mb-2"><i class="bi bi-calendar-event"></i> Date & Time</h6>
                                <h5>{{ $event->event_datetime->format('d F, Y') }}</h5>
                                <p class="text-muted">{{ $event->event_datetime->format('g:i A') }}</p>
                            </div>
                            <div class="mb-4">
                                <h6 class="text-muted mb-2"><i class="bi bi-geo-alt"></i> Location</h6>
                                <h5>{{ $event->location }}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="text-muted mb-2"><i class="bi bi-person"></i> Organizer</h6>
                                <h5>{{ $event->user->name }}</h5>
                                <p class="text-muted">{{ $event->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Seats Info -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-light border-0 text-center p-3">
                                <h6 class="text-muted">Total Seats</h6>
                                <h3 class="text-primary">{{ $event->total_seats }}</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light border-0 text-center p-3">
                                <h6 class="text-muted">Booked</h6>
                                <h3 class="text-danger">{{ $event->total_seats - $event->available_seats }}</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light border-0 text-center p-3">
                                <h6 class="text-muted">Available</h6>
                                <h3 class="text-success">{{ $event->available_seats }}</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($event->description)
                    <div class="mb-4">
                        <h5><i class="bi bi-file-text"></i> Description</h5>
                        <p class="lead">{{ $event->description }}</p>
                    </div>
                    @endif

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Seat Availability</h6>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-danger" role="progressbar" 
                                 style="width: {{ (($event->total_seats - $event->available_seats) / $event->total_seats * 100) }}%"
                                 aria-valuenow="{{ $event->total_seats - $event->available_seats }}" 
                                 aria-valuemin="0" aria-valuemax="{{ $event->total_seats }}">
                                <strong>{{ (($event->total_seats - $event->available_seats) / $event->total_seats * 100)|round(1) }}% Booked</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Section -->
                    @auth
                        @if($event->available_seats > 0)
                        <div class="card card-warning mt-4 border-warning">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="bi bi-ticket-perforated"></i> Book Your Seats</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="seats" class="form-label">Number of Seats</label>
                                        <input type="number" class="form-control form-control-lg" id="seats" 
                                               name="seats" min="1" max="{{ $event->available_seats }}" 
                                               placeholder="Enter number of seats" value="1" required>
                                        <small class="text-muted">Max available: {{ $event->available_seats }}</small>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <button type="button" id="bookNowBtn" class="btn btn-primary btn-lg w-100" onclick="submitBooking({{ $event->id }})">
                                            <i class="bi bi-check-circle"></i> Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-danger mt-4">
                            <h5><i class="bi bi-x-circle"></i> Event Full</h5>
                            <p class="mb-0">Unfortunately, all seats for this event have been booked. Please check back later.</p>
                        </div>
                        @endif
                    @else
                        <div class="alert alert-info mt-4">
                            <h5><i class="bi bi-box-arrow-in-right"></i> Sign In to Book</h5>
                            <p class="mb-0">
                                <a href="{{ route('login') }}" class="alert-link">Login</a> or 
                                <a href="{{ route('register') }}" class="alert-link">create an account</a> to book seats for this event.
                            </p>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Info Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Event Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <strong>Status:</strong>
                            @if($event->available_seats == 0)
                                <span class="badge bg-danger">SOLD OUT</span>
                            @elseif($event->available_seats < $event->total_seats * 0.25)
                                <span class="badge bg-warning">Limited Seats</span>
                            @else
                                <span class="badge bg-success">Available</span>
                            @endif
                        </li>
                        <li class="mb-3">
                            <strong>Created:</strong> {{ $event->created_at->diffForHumans() }}
                        </li>
                        <li class="mb-3">
                            <strong>Last Updated:</strong> {{ $event->updated_at->diffForHumans() }}
                        </li>
                        <li>
                            <strong>Total Bookings:</strong> {{ $event->bookings->where('status', 'booked')->count() }}
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Share Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-share"></i> Share Event</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-facebook"></i> Share on Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($event->title) }}" 
                           target="_blank" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-twitter"></i> Share on Twitter
                        </a>
                        <button onclick="copyLink()" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-link-45deg"></i> Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
function submitBooking(eventId) {
    const seats = document.getElementById('seats').value;
    const button = document.getElementById('bookNowBtn');
    
    if (!seats || seats < 1) {
        alert('Please enter a valid number of seats');
        return;
    }

    // Disable button to prevent double submission
    button.disabled = true;
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="bi bi-hourglass-split"></i> Booking...';

    fetch('{{ route("bookings.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            event_id: eventId,
            seats: parseInt(seats)
        })
    })
    .then(response => {
        // Check if response is ok
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.error || 'Booking failed');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.success);
            // Redirect after 1 second
            setTimeout(() => {
                window.location.href = '{{ route("bookings.index") }}';
            }, 1000);
        } else if (data.error) {
            alert('Error: ' + data.error);
            // Re-enable button
            button.disabled = false;
            button.innerHTML = originalHTML;
        }
    })
    .catch(error => {
        console.error('Booking Error:', error);
        alert('Error: ' + (error.message || 'An error occurred while booking'));
        // Re-enable button
        button.disabled = false;
        button.innerHTML = originalHTML;
    });
}

function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Link copied to clipboard!');
    });
}
</script>
@endsection
@endsection
