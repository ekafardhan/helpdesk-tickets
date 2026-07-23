@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="card shadow-sm">
            <div class="card-header bg-primary  text-light">
                <h5 class="mb-0">Formulir Edit User</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control form-control-sm" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control form-control-sm" id="password" name="password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control form-control-sm" id="password_confirmation"
                                name="password_confirmation">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-select form-select-sm" id="role" name="role">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <!-- Tombol Cancel -->
                        <button type="button" class="btn btn-secondary shadow-sm me-2" onclick="window.history.back();">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
