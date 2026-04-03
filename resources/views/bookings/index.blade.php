@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-5 fw-bold">My Bookings</h1>
            <p class="lead">Manage and view all your event bookings</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-bookmark-check display-4 text-success"></i>
                    <h5 class="card-title mt-3">Active Bookings</h5>
                    <h2 class="text-success">{{ $bookings->where('status', 'booked')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-bookmark-x display-4 text-danger"></i>
                    <h5 class="card-title mt-3">Cancelled Bookings</h5>
                    <h2 class="text-danger">{{ $bookings->where('status', 'cancelled')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-people display-4 text-info"></i>
                    <h5 class="card-title mt-3">Total Seats Booked</h5>
                    <h2 class="text-info">{{ $bookings->where('status', 'booked')->sum('seats') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    @if($bookings->count() > 0)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-table"></i> Booking History</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Event Title</th>
                            <th>Location</th>
                            <th>Date & Time</th>
                            <th class="text-center">Seats</th>
                            <th class="text-center">Status</th>
                            <th>Booked On</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr class="{{ $booking->status === 'cancelled' ? 'table-secondary' : '' }}">
                            <td>
                                <a href="{{ route('events.show', $booking->event) }}" class="text-decoration-none fw-bold">
                                    {{ $booking->event->title }}
                                </a>
                            </td>
                            <td>
                                <i class="bi bi-geo-alt"></i> {{ $booking->event->location }}
                            </td>
                            <td>
                                <i class="bi bi-calendar-event"></i> {{ $booking->event->event_datetime->format('d M, Y H:i') }}
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $booking->seats }} Seat{{ $booking->seats !== 1 ? 's' : '' }}</span>
                            </td>
                            <td class="text-center">
                                @if($booking->status === 'booked')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> Cancelled
                                    </span>
                                @endif
                            </td>
                            <td>{{ $booking->booking_date->format('d M, Y') }}</td>
                            <td class="text-center">
                                @if($booking->status === 'booked')
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            data-bs-toggle="modal" data-bs-target="#cancelModal{{ $booking->id }}">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </button>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
            <div class="card-footer bg-light border-top">
                {{ $bookings->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>

        <!-- Cancel Confirmation Modals -->
        @foreach($bookings->where('status', 'booked') as $booking)
        <div class="modal fade" id="cancelModal{{ $booking->id }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $booking->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel{{ $booking->id }}">
                            <i class="bi bi-exclamation-triangle"></i> Cancel Booking
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">
                            Are you sure you want to cancel your booking for <strong>{{ $booking->event->title }}</strong>?
                        </p>
                        <p class="text-muted mt-2 mb-0">This will release {{ $booking->seats }} seat@if($booking->seats !== 1)s@endif.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep Booking</button>
                        <form action="{{ route('bookings.cancel', $booking) }}" method="GET" class="d-inline">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Cancel Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    @else
        <div class="alert alert-info text-center py-5">
            <i class="bi bi-info-circle display-4"></i>
            <h4 class="mt-3">No Bookings Yet</h4>
            <p>You haven't booked any event seats yet.</p>
            <a href="{{ route('events.index') }}" class="btn btn-primary mt-3">
                <i class="bi bi-calendar"></i> Browse Events
            </a>
        </div>
    @endif
</div>
@endsection
