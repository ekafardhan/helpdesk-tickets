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
                    <a href="{{ route('admtickets.create') }}" class="btn btn-light btn-sm shadow-sm">
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

                <!-- Tabel Tiket dengan DataTables -->
                <div class="table-responsive">
                    <table id="ticketsTable" class="table table-sm table-striped table-bordered table-hover">
                        <thead class="bg-light text-center">
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Deskripsi</th>
                                <th>Nama User</th>
                                <th>Tanggal Buat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $ticket->title }}</td>
                                    <td class="align-middle">{{ $ticket->category }}</td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="badge 
                                            @if ($ticket->status === 'resolved') bg-success 
                                            @elseif ($ticket->status === 'in_progress') bg-warning 
                                            @else bg-danger @endif">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                    <td class="align-middle">{{ $ticket->description ?? 'Tidak ada deskripsi.' }}</td>
                                    <td class="align-middle">{{ $ticket->user->name ?? 'Tidak Ditemukan' }}</td>
                                    <td class="align-middle">{{ $ticket->created_at ?? 'Tidak Ditemukan' }}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            <a href="{{ route('admtickets.edit', $ticket->id) }}"
                                                class="btn btn-warning btn-sm shadow-sm me-1" title="Edit Tiket">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admtickets.destroy', $ticket->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                                    title="Hapus Tiket">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-1">
            <div class="mt-1">
                <form action="{{ route('admtickets.index') }}" method="GET" class="row g-3 m-1 mb-0">
                    <div class="col-md-4">
                        <input type="month" id="month" name="month" class="form-control form-control-sm"
                            value="{{ request('month') ?? now()->format('Y-m') }}" onchange="this.form.submit()">
                    </div>
                </form>
                <h5 class="text-center">Grafik Tiket </h5>
                <canvas id="ticketChart" width="200" height="90"></canvas>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#ticketsTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 5,
                order: [
                    [6, 'desc']
                ],
                language: {
                    lengthMenu: "Tampilkan _MENU_ ",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ tiket",
                    infoEmpty: "Tidak ada tiket tersedia",
                    infoFiltered: "(disaring dari total _MAX_ tiket)",
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



        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('ticketChart').getContext('2d');

            // Data dari server
            const dates = @json($dates);
            const chartData = @json($chartData);
            const statuses = @json($statuses);

            // Format data untuk Chart.js
            const datasets = statuses.map((status, index) => {
                return {
                    label: status.charAt(0).toUpperCase() + status.slice(1), // Kapitalisasi status
                    data: chartData.map(row => row[status]), // Ambil data jumlah tiket per status
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)', // pending
                        'rgba(255, 206, 86, 0.5)', // in_progress
                        'rgba(75, 192, 192, 0.5)', // resolved
                        'rgba(54, 162, 235, 0.5)', // open
                        'rgba(201, 203, 207, 0.5)' // close
                    ][index],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(201, 203, 207, 1)'
                    ][index],
                    borderWidth: 1
                };
            });

            // Buat stacked bar chart
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dates, // Tanggal selama bulan ini
                    datasets: datasets // Data per status
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.raw}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: true, // Batang pada sumbu X ditumpuk
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                        y: {
                            stacked: true, // Batang pada sumbu Y ditumpuk
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Tiket'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
