<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //user:role M:1
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    //task:user M:1
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    //???????????????????????????????????????????????????????
    //task:collaborator M:1
    public function taskcollaborators()
    {
        return $this->hasMany(Task::class, 'collaborator_id', 'id');
    }

    //note:user M:1
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    //issue:user M:1
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    //???????????????????????????????????????????????????????
    //issue:assignee M:1
    public function assignee()
    {
        return $this->hasMany(User::class, 'assignee_id', 'id');
    }

    //project:user M:M
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }
}
