<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email'];

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'user_colors');
    }
}

?>