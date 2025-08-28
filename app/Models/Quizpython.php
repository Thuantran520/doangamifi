<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizPython extends Model
{
    protected $table = 'quiz_python';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
    ];

}
