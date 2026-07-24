<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::all();



        $month = $request->input('month', now()->format('Y-m')); // Default ke bulan ini
        [$year, $month] = explode('-', $month); // Pisahkan tahun dan bulan

        $ticketsPerDate = \App\Models\Ticket::selectRaw('DATE(created_at) as date, status, COUNT(*) as count')
            ->whereYear('created_at', $year) // Filter tahun
            ->whereMonth('created_at', $month) // Filter bulan
            ->groupBy('date', 'status') // Group berdasarkan tanggal dan status
            ->orderBy('date') // Urutkan berdasarkan tanggal
            ->get()
            ->groupBy('date');

        // Format data untuk grafik
        $dates = [];
        $statuses = ['pending', 'in_progress', 'resolved', 'open', 'close']; // Status yang ada
        $chartData = [];

        foreach ($ticketsPerDate as $date => $data) {
            $dates[] = $date;
            $statusCounts = $statuses;
            foreach ($statuses as $status) {
                $statusCounts[$status] = $data->firstWhere('status', $status)->count ?? 0;
            }
            $chartData[] = $statusCounts;
        }


        return view('admin.tickets.index', compact(
            'tickets',
            'dates',
            'chartData',
            'statuses'
        ));
    }

    public function create()
    {
        $users = User::all(); // Daftar user untuk field Assigned To
        return view('admin.tickets.create', compact('users')); // Menampilkan form create tiket
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:hardware,software',
            'status' => 'required|in:pending,in_progress,resolved,open,close',
            'assigned_to' => 'nullable|exists:users,id',
            'description' => 'required|string', // Menambahkan deskripsi
        ]);

        // Menyimpan data tiket baru
        Ticket::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'category' => $request->category,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'description' => $request->description, // Menyimpan deskripsi
        ]);

        return redirect()->route('admtickets.index')->with('success', 'Tiket berhasil dibuat.');
    }

    public function edit($id)
    {
        $users = User::all(); // Assuming you want to display all users in the select dropdown

        $ticket = Ticket::findOrFail($id);
        return view('admin.tickets.edit', compact('ticket', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:hardware,software',
            'status' => 'required|in:pending,in_progress,resolved,open,close', // Adding status validation
            'assigned_to' => 'nullable|exists:users,id',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update($validatedData);

        return redirect()->route('admtickets.index')->with('success', 'Tiket berhasil diperbarui!');
    }


    public function destroy($id)
    {
        Ticket::findOrFail($id)->delete();
        return redirect()->route('admtickets.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
