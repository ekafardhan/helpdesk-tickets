@extends('layouts.master')

@section('content')
    <div class="container mt-2">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Buat Tiket Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admtickets.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" id="title" name="title"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan judul tiket"
                            required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select name="category" id="category" class="form-select @error('category') is-invalid @enderror"
                            required>
                            <option value="" disabled selected>Pilih kategori</option>
                            <option value="hardware">Hardware</option>
                            <option value="software">Software</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                            required>
                            <option value="" disabled selected>Pilih status</option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="resolved">Resolved</option>
                            <option value="open">Open</option>
                            <option value="close">Close</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">Assigned Person</label>
                        <select name="assigned_to" id="assigned_to" class="form-select @error('assigned_to') is-invalid @enderror">
                            <option value="" selected>-- Pilih Assigned Person (Opsional) --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="form-control @error('description') is-invalid @enderror" placeholder="Jelaskan masalah Anda secara detail"
                            required></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <!-- Tombol Cancel -->
                        <button type="button" class="btn btn-secondary shadow-sm me-2" onclick="window.history.back();">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim Tiket
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
