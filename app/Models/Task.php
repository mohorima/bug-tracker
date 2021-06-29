<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tasks';

    protected $fillable = [
        'subject',
        'description',
        'priority',
        'status',
        'tag',
        'milestone',
        'startDate',
        'endDate',
        'user_id',
        'project_id',
        'collaborator_id',
    ];

    //task:user M:1
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //task:project M:1
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    //task:collaborator M:1
    public function collaborator()
    {
        return $this->belongsTo(User::class, 'collaborator_id', 'id');
    }
}
