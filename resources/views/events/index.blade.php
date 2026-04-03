@extends('layouts.app')

@section('content')
<div class="container">
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-3">Discover Amazing Events</h1>
                    <p class="lead">Find and book seats for your favorite events</p>
                </div>
                <div class="col-md-4 text-end">
                    @auth
                    <a href="{{ route('events.create') }}" class="btn btn-light btn-lg fw-bold">
                        <i class="bi bi-plus-circle"></i> Create Event
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg fw-bold">
                        <i class="bi bi-box-arrow-in-right"></i> Login to Create
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('events.index') }}" class="row g-3">
                <div class="col-md-5">
                    <label for="location" class="form-label">Search by Location</label>
                    <input type="text" class="form-control" id="location" name="location" 
                           placeholder="Enter location..." value="{{ request('location') }}">
                </div>
                <div class="col-md-5">
                    <label for="date" class="form-label">Filter by Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Events Grid -->
    @if($events->count() > 0)
        <div class="row g-4">
            @foreach($events as $event)
            <div class="col-lg-4 col-md-6">
                <div class="card event-card h-100">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title mb-2">{{ $event->title }}</h5>
                                <div class="event-date">
                                    <i class="bi bi-calendar-event"></i> 
                                    {{ $event->event_datetime->format('d M, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted">{{ Str::limit($event->description, 100) }}</p>
                        
                        <div class="mb-3">
                            <p class="mb-2">
                                <i class="bi bi-geo-alt"></i> <strong>{{ $event->location }}</strong>
                            </p>
                            <p class="mb-0">
                                <i class="bi bi-clock"></i> 
                                {{ $event->event_datetime->format('H:i A') }}
                            </p>
                        </div>

                        <div class="mb-3 p-3 bg-light rounded">
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted d-block">Total Seats</small>
                                    <strong class="h6">{{ $event->total_seats }}</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Available</small>
                                    <strong class="h6 
                                        @if($event->available_seats == 0) text-danger
                                        @elseif($event->available_seats <= $event->total_seats * 0.25) text-warning
                                        @else text-success
                                        @endif
                                    ">
                                        {{ $event->available_seats }}
                                    </strong>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="bi bi-person"></i> 
                                Created by: <strong>{{ $event->user->name }}</strong>
                            </small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <div class="d-grid gap-2">
                            <a href="{{ route('events.show', $event) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i> View Details
                            </a>
                            @auth
                                @if(auth()->id() === $event->user_id)
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure?');">
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
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info text-center py-5" role="alert">
            <i class="bi bi-info-circle display-4"></i>
            <h4 class="mt-3">No Events Found</h4>
            <p>Try adjusting your filters or check back later for new events.</p>
            @auth
            <a href="{{ route('events.create') }}" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle"></i> Create First Event
            </a>
            @endauth
        </div>
    @endif
</div>
@endsection