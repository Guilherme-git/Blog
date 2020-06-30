<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $table = "admin";
    public $timestamps = false;

    protected $fillable = [
        'email_admin',
        'senha_admin'
    ];
}
