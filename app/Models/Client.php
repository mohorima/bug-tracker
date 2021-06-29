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
        'city',
        'state',
        'zip',
        'country',
        'contactPerson',
        'email',
        'phone',
        'website',
        'clientGroup',
        'vatNumber',
        'billingAddress',
        'billingCity',
        'billingState',
        'billingZip',
        'billingCountry',
    ];

    //project:client M:1
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
