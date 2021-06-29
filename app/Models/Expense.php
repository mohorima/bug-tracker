<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Expense extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'expenses';

    protected $fillable = [
        'name',
        'description',
        'category',
        'date',
        'amount',
        'paymentMode',
        'vendor_id',
    ];

    //expense:vendor M:1
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
