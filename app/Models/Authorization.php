<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    use HasFactory;

    protected $fillable = ['role_id', 'authorization_type_id', 'menu_id'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function authorization_type()
    {
        return $this->belongsTo(AuthorizationType::class, 'authorization_type_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
