<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizationType extends Model
{
    use HasFactory;

    protected $fillable = ['type_name'];
    protected $guarded = ['id'];
    public $timestamps = false;
}
