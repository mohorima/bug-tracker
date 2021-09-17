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

    //role consts after seeding RoleSeeder
    public const IS_ADMIN = 1;
    public const IS_USER = 2;
    public const IS_MANAGER = 3;
    public const IS_TEAMLEADER = 4;

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
