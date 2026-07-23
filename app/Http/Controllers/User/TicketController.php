<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Events\TicketCreated;


class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();
        return view('user.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('user.tickets.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'title' => 'required',
            'category' => 'required|in:hardware,software',
            'description' => 'required',
        ]);

        // Simpan tiket ke database
        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            // 'status' => $request->status, // Tambahkan jika diperlukan
        ]);

        // Dispatch event setelah tiket dibuat

        // Redirect ke halaman lain dengan pesan sukses
        return redirect()->route('usrtickets.index')->with('success', 'Tiket berhasil dibuat.');
    }


    public function edit($id)
    {
        $ticket = Ticket::where('user_id', auth()->id())->findOrFail($id);
        return view('user.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {

        // dd($request->toArray());
        $ticket = Ticket::where('user_id', auth()->id())->findOrFail($id);
        $ticket->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('usrtickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }
}
