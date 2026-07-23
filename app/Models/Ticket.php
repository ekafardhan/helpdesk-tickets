<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    // Tentukan atribut yang dapat diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'status',
    ];

    // Relasi: Ticket milik User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
