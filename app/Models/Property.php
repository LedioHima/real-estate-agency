<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'city',
        'type',
        'price',
        'image',
        'description',
        'user_id', // assigned agent
    ];

    // Automatically generate a slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            $property->slug = Str::slug($property->title);
        });
    }

    /**
     * A property belongs to a user with the role 'agent'
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'agent');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

}
