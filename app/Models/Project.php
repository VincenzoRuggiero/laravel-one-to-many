<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'link', 'created', 'slug', 'image'
    ];

    //Function that show each item's title after the domain instead of it's id
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
