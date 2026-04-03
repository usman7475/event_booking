@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><i class="bi bi-plus-circle"></i> Create New Event</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('events.store') }}" method="POST" class="needs-validation">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                <i class="bi bi-pencil"></i> Event Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" placeholder="Enter event title" 
                                   value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="bi bi-file-text"></i> Description
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" 
                                      placeholder="Enter event description...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label">
                                <i class="bi bi-geo-alt"></i> Location <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" placeholder="Enter event location" 
                                   value="{{ old('location') }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Event Date & Time -->
                            <div class="col-md-6 mb-3">
                                <label for="event_datetime" class="form-label">
                                    <i class="bi bi-calendar-event"></i> Date & Time <span class="text-danger">*</span>
                                </label>
                                <input type="datetime-local" class="form-control @error('event_datetime') is-invalid @enderror" 
                                       id="event_datetime" name="event_datetime" 
                                       value="{{ old('event_datetime') }}" required>
                                @error('event_datetime')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Total Seats -->
                            <div class="col-md-6 mb-3">
                                <label for="total_seats" class="form-label">
                                    <i class="bi bi-people"></i> Total Seats <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('total_seats') is-invalid @enderror" 
                                       id="total_seats" name="total_seats" min="1" placeholder="e.g., 100" 
                                       value="{{ old('total_seats') }}" required>
                                @error('total_seats')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg flex-grow-1">
                                <i class="bi bi-check-circle"></i> Create Event
                            </button>
                            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
