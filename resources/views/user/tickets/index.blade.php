@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        @if (session('admin_notification'))
            <div class="alert alert-info">
                {{ session('admin_notification') }}
            </div>
        @endif



        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Daftar Tiket</h4>
                    <a href="{{ route('usrtickets.create') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="fas fa-plus"></i> Buat Tiket Baru
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="tickets-table" class="table table-sm table-striped table-bordered table-hover">
                        <thead class="bg-light text-center">
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tickets as $ticket)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $ticket->title }}</td>
                                    <td class="align-middle">{{ $ticket->category }}</td>
                                    <td class="align-middle">{{ $ticket->description ?? 'Tidak ada deskripsi.' }}</td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="badge 
        @if ($ticket->status === 'resolved') bg-success 
        @elseif ($ticket->status === 'in_progress') bg-warning 
        @else bg-danger @endif">

                                            <!-- Ikon sesuai status -->
                                            <i
                                                class="fas 
            @if ($ticket->status === 'resolved') fa-check 
            @elseif ($ticket->status === 'in_progress') fa-clock 
            @else fa-exclamation-triangle @endif">
                                            </i>

                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            <a href="{{ route('usrtickets.edit', $ticket->id) }}"
                                                class="btn btn-warning btn-sm shadow-sm" title="Edit Tiket">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- Uncomment the form below to enable delete functionality --}}
                                            {{-- 
                                            <form action="{{ route('usrtickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm shadow-sm" title="Hapus Tiket">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Tidak ada tiket ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tickets-table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 5,
                order: [
                    [0, 'asc']
                ], // Urutkan berdasarkan kolom ID (kolom pertama)
                language: {
                    lengthMenu: "Tampilkan _MENU_ entri per halaman",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    infoEmpty: "Tidak ada entri tersedia",
                    infoFiltered: "(disaring dari total _MAX_ entri)",
                    search: "Cari:",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });
    </script>
@endsection
