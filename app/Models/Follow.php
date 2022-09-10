<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follow extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'follow_by',
        'created_at'
    ];
    public function users(){
        return $this->belongsTo(User::class);
    }
}
