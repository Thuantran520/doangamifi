<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
use App\Models\Badge;
use App\Models\QuizPython;
use App\Models\QuizAttempt; // Đảm bảo đã có dòng này

class QuizPythonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QuizPython::query();

        // existing full-text search
        if ($q = $request->get('q')) {
            $query->where('question_text', 'like', '%'.$q.'%');
        }

        // new: support single topic or multiple topics[]
        if ($request->filled('topics')) {
            $topics = $request->input('topics');
            if (!is_array($topics)) $topics = [$topics];
            $query->whereIn('topic', $topics);
        } elseif ($request->filled('topic')) {
            $query->where('topic', $request->input('topic'));
        }

        // return limited random set (adjust limit as needed)
        $items = $query->inRandomOrder()->limit(10)->get();

        return view('quizpython.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quizpython.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'question_text'  => 'required|string',
            'option_a'       => 'required|string',
            'option_b'       => 'required|string',
            'option_c'       => 'required|string',
            'option_d'       => 'required|string',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        QuizPython::create($data);

        return redirect()->route('quizpython.index')->with('success', 'Tạo câu hỏi thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuizPython $quiz)
    {
        return view('quizpython.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuizPython $quiz)
    {
        return view('quizpython.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuizPython $quiz)
    {
        $data = $request->validate([
            'question_text'  => 'required|string',
            'option_a'       => 'required|string',
            'option_b'       => 'required|string',
            'option_c'       => 'required|string',
            'option_d'       => 'required|string',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        $quiz->update($data);

        return redirect()->route('quizpython.index')->with('success', 'Cập nhật câu hỏi thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuizPython $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizpython.index')->with('success', 'Xóa câu hỏi thành công.');
    }


    public function submit(Request $request)
    {
        // --- Lấy dữ liệu & Chấm điểm ---
        $answers = $request->input('answers', []);
        $allQuestionIds = explode(',', $request->input('question_ids'));
        $totalQuestions = count($allQuestionIds);
        $questions = \App\Models\QuizPython::whereIn('id', $allQuestionIds)->get();

        $correctAnswersCount = 0;
        foreach ($questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] === $question->correct_answer) {
                $correctAnswersCount++;
            }
        }
        $score = $correctAnswersCount * 10;
        $max_score = $totalQuestions * 10;

        // --- Lưu điểm, lịch sử và huy hiệu ---
        $user = \Illuminate\Support\Facades\Auth::user();
        $newBadges = []; // Khởi tạo mảng huy hiệu mới
        if ($user) {
            // 1. Cộng dồn tổng điểm
            $userScore = Score::firstOrCreate(['user_id' => $user->id]);
            $userScore->score += $score;
            $userScore->save();

            // 2. LƯU LẠI LỊCH SỬ LÀM BÀI (PHẦN BỊ THIẾU)
            QuizAttempt::create([
                'user_id'   => $user->id,
                'quiz_type' => 'python',
                'score'     => $score,
                'max_score' => $max_score,
                'answers'   => $answers,
                'passed'    => ($score >= $max_score / 2),
            ]);

            // 3. Kiểm tra và tặng huy hiệu
            if ($userScore->score >= 100 && !$user->badges()->where('name', 'Tân Binh')->exists()) {
                $badge = Badge::where('name', 'Tân Binh')->first();
                if ($badge) {
                    $user->badges()->attach($badge->id);
                    $newBadges[] = $badge;
                }
            }
            if ($userScore->score >= 1000 && !$user->badges()->where('name', 'Chuyên Gia')->exists()) {
                $badge = Badge::where('name', 'Chuyên Gia')->first();
                if ($badge) {
                    $user->badges()->attach($badge->id);
                    $newBadges[] = $badge;
                }
            }
        }

        // --- Chuẩn bị dữ liệu chi tiết để hiển thị ---
        $results = [];
        foreach ($questions as $question) {
            $results[] = [
                'question_text'  => $question->question_text,
                'options'        => [
                    'a' => $question->option_a,
                    'b' => $question->option_b,
                    'c' => $question->option_c,
                    'd' => $question->option_d,
                ],
                'correct_answer' => $question->correct_answer,
                'selected'       => $answers[$question->id] ?? null,
            ];
        }

        // --- Trả về view kết quả chi tiết ---
        return view('quizpython.submit', [
            'score'     => $score,
            'total'     => $max_score,
            'results'   => $results,
            'newBadges' => $newBadges, // Gửi huy hiệu mới nhận được sang view
        ]);
    }
}
