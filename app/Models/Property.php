<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Add this
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory; // <-- Add this line

    protected $fillable = [
        'title',
        'slug',
        'city',
        'type',
        'price',
        'image',
        'description',
        'agent_id'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
