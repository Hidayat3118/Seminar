<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
   use HasFactory;
   protected $fillable = [
    'foto',
   ];

    public function user(){
        return $this->hasOne(User::class);
    }
}
