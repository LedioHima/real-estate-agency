<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Check role
    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isAgent() {
        return $this->role === 'agent';
    }

    public function isGuestUser() {
        return $this->role === 'guest';
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }


}
