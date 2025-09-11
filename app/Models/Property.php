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
        'user_id',
    ];

    // Automatically generate a slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            $property->slug = Str::slug($property->title);
        });
    }

    // Relationship: Property belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
