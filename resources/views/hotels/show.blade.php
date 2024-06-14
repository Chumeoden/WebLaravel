<!-- resources/views/hotels/show.blade.php -->
@extends('dashboard.app')

@section('content')
<div class="container content-container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Hotels</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Hotels</a>
                </li>
                <li class="icon-arrow-right">
                    <a href="#">Show Hotels</a>
                </li>
            </ul>
        </div>
    </div>
<div class="container">
    <div class="card">
        <div class="card-header">
            Hotel Details
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-group">
                <label for="name">Hotel Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $hotel->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $hotel->address }}" disabled>
            </div>
            <!-- Add more fields as needed -->

            <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning">Edit Hotel</a>
        </div>
    </div>

    <!-- Add section for managing rooms, etc. -->
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