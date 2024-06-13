@extends('dashboard.app')

@section('content')
<div class="container content-container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Account and Role</h3>
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
                    <a href="#">Management</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Account and Role</a>
                </li>
            </ul>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('account_and_role.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>

            <h4 class="mt-4">Account List</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->email }}</td>
                        <td>{{ $account->role }}</td>
                        <td>
                            <a href="{{ route('account_and_role.edit', $account->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('account_and_role.destroy', $account->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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