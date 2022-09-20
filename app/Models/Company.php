<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'cpfcnpj',
        'rg',
        'ie',
        'im',
        'address',
        'zipcode',
        'phone',
        'email'
    ];


    public function Users(){
        return $this->hasMany(User::class);
    }
}
