<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Javascript extends Model
{
    protected $table = 'javascript';
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
