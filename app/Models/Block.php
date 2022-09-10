<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'block_by',
        'created_at'
    ];
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
