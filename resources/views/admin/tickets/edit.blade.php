@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Edit Tiket</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admtickets.update', $ticket->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div class="form-group row mb-3">
                        <label for="title" class="col-sm-3 col-form-label">Judul Tiket</label>
                        <div class="col-sm-9">
                            <input type="text" id="title" name="title"
                                class="form-control form-control-md shadow-sm" value="{{ old('title', $ticket->title) }}"
                                required>
                        </div>
                    </div>

                    <!-- Category Field -->
                    <div class="form-group row mb-3">
                        <label for="category" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <select name="category" id="category" class="form-select form-select-md shadow-sm" required>
                                <option value="hardware" {{ $ticket->category == 'hardware' ? 'selected' : '' }}>Hardware
                                </option>
                                <option value="software" {{ $ticket->category == 'software' ? 'selected' : '' }}>Software
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Status Field -->
                    <div class="form-group row mb-3">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <!-- Radio buttons for status options -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="pending" value="pending"
                                    {{ $ticket->status == 'pending' ? 'checked' : '' }}>
                                <label class="form-check-label" for="pending">
                                    <span class="badge bg-danger">
                                        <i class="fas fa-exclamation-triangle"></i> Pending
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="in_progress"
                                    value="in_progress" {{ $ticket->status == 'in_progress' ? 'checked' : '' }}>
                                <label class="form-check-label" for="in_progress">
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock"></i> In Progress
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="resolved"
                                    value="resolved" {{ $ticket->status == 'resolved' ? 'checked' : '' }}>
                                <label class="form-check-label" for="resolved">
                                    <span class="badge bg-success">
                                        <i class="fas fa-check"></i> Resolved
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="open" value="open" {{ $ticket->status == 'open' ? 'checked' : '' }}>
                                <label class="form-check-label" for="open">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-folder-open"></i> Open
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="close" value="close" {{ $ticket->status == 'close' ? 'checked' : '' }}>
                                <label class="form-check-label" for="close">
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-times"></i> Close
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <!-- Description Field -->
                    <div class="form-group row mb-3">
                        <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea name="description" id="description" class="form-control form-control-md shadow-sm" rows="4" required>{{ old('description', $ticket->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Assigned Person Field -->
                    <div class="form-group row mb-3">
                        <label for="assigned_to" class="col-sm-3 col-form-label">Assigned Person</label>
                        <div class="col-sm-9">
                            <select class="form-select form-select-md shadow-sm" id="assigned_to" name="assigned_to">
                                <option value="">-- Tidak ada --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- User Field -->
                    <div class="form-group row mb-3">
                        <label for="user" class="col-sm-3 col-form-label">Nama User</label>
                        <div class="col-sm-9">
                            <select class="form-select form-select-md shadow-sm" id="user" name="user_id" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $ticket->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group row">
                        <div class="col-sm-12 text-end">
                            <button type="button" class="btn btn-secondary shadow-sm mt-3 ms-2"
                                onclick="window.history.back();">Cancel</button>
                            <button type="submit" class="btn btn-success shadow-sm mt-3">Update Tiket</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
