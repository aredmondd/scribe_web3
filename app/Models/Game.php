<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Game extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function User() {
        return $this->belongsTo(User::class);
    }
}
