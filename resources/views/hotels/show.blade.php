<!-- resources/views/hotels/show.blade.php -->
@extends('dashboard.app')

@section('content')
<div class="container content-container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Hotel Details</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('hotels.index') }}">Hotels</a>
                </li>
                <li class="icon-arrow-right">
                    <span>Show Hotel</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Hotel Information
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-group">
    <label for="image">Hotel Image</label>
    <div>
        @if ($hotel->image)
            <img src="{{ asset('storage/' . $hotel->image) }}" alt="Hotel Image" class="img-thumbnail">
        @else
            <p>No image available</p>
        @endif
    </div>
</div>
<div class="form-group">
    <label for="room_count">Number of Rooms</label>
    <input type="text" class="form-control" id="room_count" name="room_count" value="{{ $hotel->room_count }}" disabled>
</div>
<div class="form-group">
    <label for="room_types">Room Types</label>
    <ul>
        @php
            $roomTypes = json_decode($hotel->room_types);
        @endphp
        @foreach ($roomTypes as $type)
            <li>{{ $type }}</li>
        @endforeach
    </ul>
</div>

                <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning">Edit Hotel</a>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .content-container {
        margin-top: 80px;
    }
    .page-header {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .page-header h3 {
        text-align: center;
    }
    .breadcrumbs {
        display: flex;
        justify-content: center;
        width: 100%;
        list-style: none;
        padding: 0;
    }
    .breadcrumbs .nav-home {
        margin-right: auto;
    }
</style>
