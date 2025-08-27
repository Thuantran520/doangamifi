<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    // nếu bảng của bạn không theo dạng plural 'quizzes', đặt tên bảng đúng:
    protected $table = 'quiz_questions';

    protected $fillable = [
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
    ];
}
