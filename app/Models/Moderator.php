<?php

namespace App\Models;

use App\Models\Seminar;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moderator extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seminar(){
        return $this->hasMany(Seminar::class);
    }

    public function kategoris(){
        return $this->belongsToMany(Kategori::class, 'moderator_kategori');
    }
}
