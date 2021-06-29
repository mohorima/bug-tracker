<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'payments';

    protected $fillable = [
        'date',
        'amount',
        'description',
        'paymentMode',
        'invoice_id',
    ];

    //payment:invoice 1:1
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_id');
    }
}
