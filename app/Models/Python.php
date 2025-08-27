<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Python extends Model
{
    protected $table = 'python';
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
