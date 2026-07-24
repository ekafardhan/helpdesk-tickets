@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Edit Tiket</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('usrtickets.update', $ticket->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div class="form-group row mb-3">
                        <label for="title" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <input type="text" id="title" name="title"
                                class="form-control form-control-md shadow-sm" value="{{ $ticket->title }}" required>
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
                            <select name="status" id="status" class="form-select form-select-md shadow-sm" required>
                                <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="close" {{ $ticket->status == 'close' ? 'selected' : '' }}>Close</option>
                            </select>
                        </div>
                    </div>

                    <!-- Description Field -->
                    <div class="form-group row mb-3">
                        <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea name="description" id="description" class="form-control form-control-md shadow-sm" rows="4" required>{{ $ticket->description }}</textarea>
                        </div>
                    </div>

                    <!-- Right-aligned Button -->
                    <div class="form-group row">
                        <div class="col-sm-12 text-end">
                            <!-- Tombol Cancel -->
                            <button type="button" class="btn btn-secondary shadow-sm mt-3 ms-2"
                                onclick="window.history.back();">Cancel</button>
                            <!-- Tombol Update Tiket -->
                            <button type="submit" class="btn btn-success shadow-sm mt-3">Update Tiket</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
