@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary mb-3"><i class="fas fa-user-plus"></i> Tambah
            User</a>

        @if (session('success'))
            <div class="alert alert-success alert-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Container -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary  text-light">
                <h5 class="mb-0 m-0">Daftar Semua User</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="userTable">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->role == 'admin' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning me-2"
                                            title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 5,
                order: [
                    [0, 'asc'] // Sort by name column initially
                ],
                language: {
                    lengthMenu: "Tampilkan _MENU_ per halaman",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(disaring dari _MAX_ total data)",
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
