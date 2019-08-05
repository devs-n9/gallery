<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $table = 'gallery';
    
    protected $fillable = ['title', 'preview', 'description', 'private', 'path', 'user_id'];
}
