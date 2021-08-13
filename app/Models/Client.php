<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'clients';

    protected $fillable = [
        'company',
        'owner',
        'address',
        'country',
        'contactPerson',
        'email',
        'phone',
        'website',
    ];

    //project:client M:1
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
