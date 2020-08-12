<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'middle_name', 'last_name'];

    public function books() {
        return $this->belongsToMany('\App\Book');
    }
}
