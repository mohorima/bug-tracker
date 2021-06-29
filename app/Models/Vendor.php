<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'vendors';

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'contactPerson',
        'email',
        'phone',
        'website',
    ];

    //expense:vendor M:1
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
