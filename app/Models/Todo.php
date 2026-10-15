<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * Fields that can be mass-assigned (safe to fill from form input)
     * Without this, Laravel blocks mass assignment for security
     */
    protected $fillable = [
        'title',
        'description',
        'is_completed',
    ];

    /**
     * Cast is_completed to boolean automatically
     * So it's always true/false instead of 1/0
     */
    protected $casts = [
        'is_completed' => 'boolean',
    ];
}
