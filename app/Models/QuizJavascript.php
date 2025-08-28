<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizJavascript extends Model
{
    // table name (the DB table you said exists)
    protected $table = 'quiz_javascript';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    // Use Eloquent timestamps (created_at, updated_at) like quiz_python
    public $timestamps = true;

    protected $fillable = [
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'difficulty',
        'topic',
    ];
}
