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
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Create Hotels</a>
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

                <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Hotel Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter hotel name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter hotel address" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="room_count">Number of Rooms</label>
                        <input type="number" class="form-control" id="room_count" name="room_count" placeholder="Enter number of rooms" required>
                    </div>
                    <div class="form-group">
                        <label for="room_types">Room Types</label>
                        <div id="room_types_container">
                            <input type="text" class="form-control mb-2" name="room_types[]" placeholder="Enter room type" required>
                        </div>
                        <button type="button" class="btn btn-secondary" id="add_room_type">Add Room Type</button>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Hotel List -->
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
                                <th scope="col">ID</th>
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
                                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this hotel?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <!-- End Hotel List -->

    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('add_room_type').addEventListener('click', function() {
        const container = document.getElementById('room_types_container');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'room_types[]';
        input.placeholder = 'Enter room type';
        input.className = 'form-control mb-2';
        input.required = true;
        container.appendChild(input);
    });
</script>
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
