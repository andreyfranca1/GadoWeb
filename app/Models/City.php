<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Finder\name;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public function state(){
        $this->belongsTo(State::class, 'state_id');
    }

}
