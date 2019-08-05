<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $table = 'photos';
    
    protected $fillable = ['name', 'preview', 'image', 'description', 'private', 'data', 'gallery_id'];
    
    public function gallery()
    {
        return $this->hasOne('App\Models\Gallery', 'id', 'gallery_id');
    }
}