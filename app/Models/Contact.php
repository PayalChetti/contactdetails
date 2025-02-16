<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    protected $table = 'userdata';
    protected $primarykey = 'id';
    protected $fillable = ['name', 'phone_number'];
    use HasFactory;
}
