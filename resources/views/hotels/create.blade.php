@extends('dashboard.app')

@section('content')
<div class="container content-container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Hotel</h3>
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
                    <a href="#">Manager Hotels</a>
                </li>
                <li class="nav-item">
                    <a href="#"></a>
                </li>
            </ul>
        </div>
    </div>
<div class="container">
    <div class="card">
        <div class="card-header">
            Add New Hotel
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('hotels.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Hotel Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter hotel name" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter hotel address" required>
                </div>
                <!-- Add more fields as needed -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Hotels List
        </div>
        <div class="card-body">
            @if ($hotels->isEmpty())
                <p>No hotels found.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Hotel Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hotels as $hotel)
                            <tr>
                                <th scope="row">{{ $hotel->id }}</th>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->address }}</td>
                                <td>
                                    <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <!-- You can add delete functionality here -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
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