<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status', // e.g., open or closed
    ];

    /**
     * Ticket belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
