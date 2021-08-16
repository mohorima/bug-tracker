<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invoice extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'invoices';

    protected $fillable = [
        'invoiceNum',
        'billDate',
        'dueDate',
        'amount',
        'paymentMode',
        'tax',
        'recurring',
        'note',
        'project_id',
    ];

    //invoice:project M:1
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    //invoice:payment 1:1
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
