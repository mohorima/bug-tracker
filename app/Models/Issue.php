<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Issue extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'issues';

    protected $fillable = [
        'title',
        'description',
        'type',
        'severity',
        'flag',
        'dueDate',
        'status',
        'tag',
        'user_id',
        'project_id',
        'assignee_id',
    ];

    //issue:user M:1
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //issue:project M:1
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    //issue:assignee M:1
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }
}
