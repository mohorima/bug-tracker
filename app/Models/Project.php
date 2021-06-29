<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'startDate',
        'endDate',
        'billingType',
        'cost',
        'estHours',
        'tag',
        'status',
        'client_id',
    ];

    //project:client M:1
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    //task:project M:1
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    //issue:project M:1
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    //invoice:project M:1
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    //project:user M:M
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
