<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'roles';

    protected $fillable = ['name', 'description'];

    //user:role M:1
    public function users()
    {
        return $this->hasMany(User::class);
    }

    //permission:role M:M
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
}
