<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','email','subject','body','ip','user_agent'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
