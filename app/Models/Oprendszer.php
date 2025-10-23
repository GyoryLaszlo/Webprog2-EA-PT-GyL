<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oprendszer extends Model
{
    protected $table = 'oprendszer';
    protected $fillable = ['nev'];
    public function gepek(){ return $this->hasMany(Gep::class, 'oprendszerid'); }
}
