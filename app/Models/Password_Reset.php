<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Password_Reset extends Model
{
    protected $table = 'password_resets';
    protected $fillable = ['email','token'];
//    public $timestamps = true;
}
