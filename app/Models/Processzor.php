<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processzor extends Model
{
    protected $table = 'processzor';
    protected $fillable = ['gyarto','tipus'];
    public function gepek(){ return $this->hasMany(Gep::class, 'processzorid'); }
}
