<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_colors');
    }
}

?>