<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cpp extends Model
{
    protected $table = 'cpp';
    protected $primaryKey = 'lesson_id';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'content',
        'example',
        'topic',
        'order',
        'created_at',
        'updated_date',
    ];
}
