<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    protected $table = 'beers';

    protected $fillable = [
        'name',
        'description',
        'first_brewed'
    ];

    public $timestamps = false;

    public $hidden = [
        'created_at', 'updated_at'
    ];
}
