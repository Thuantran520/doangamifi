<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizCpp extends Model
{
    // table name (change if your DB table is named differently)
    protected $table = 'quiz_cpp';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    // Use Eloquent timestamps (created_at, updated_at)
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
