<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'year_publication'];

    public function authors() {
        return $this->belongsToMany('\App\Author');
    }

    public function genres() {
        return $this->belongsToMany('\App\Genre');
    }
}
