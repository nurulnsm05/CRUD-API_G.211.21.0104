<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class makul extends Model
{
    /** @use HasFactory<\Database\Factories\MakulFactory> */
    use HasFactory;
    protected $fillable = [
        'namamakul',
        'idmakul',
        'semester',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}