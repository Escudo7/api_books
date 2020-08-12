<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function books() {
        return $this->belongsToMany('\App\Book');
    }
}
