@extends('dashboard.app')

@section('content')

<div class="container content-container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Hotels</h3>
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
                    <a href="{{ route('hotels.create') }}">Hotels</a>
                </li>
                <li class="icon-arrow-right">
                    <a href="#">Edit Hotels</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Hotel
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Hotel Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $hotel->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $hotel->address }}" required>
                    </div>
                    <div class="form-group">
                        <label for="room_count">Number of Rooms</label>
                        <input type="number" class="form-control" id="room_count" name="room_count" value="{{ $hotel->room_count }}" required>
                    </div>
                    <div class="form-group">
                        <label for="room_types">Room Types (comma-separated)</label>
                        <input type="text" class="form-control" id="room_types" name="room_types" value="{{ implode(', ', json_decode($hotel->room_types)) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Hotel Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
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
