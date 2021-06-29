<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Note extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'notes';

    protected $fillable = [
        'title',
        'description',
        'tag',
        'user_id',
    ];

    //note:user M:1
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
