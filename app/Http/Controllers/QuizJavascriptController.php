<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizJavascript;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
use App\Models\Badge; // <-- THÊM DÒNG NÀY

class QuizJavascriptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QuizJavascript::query();

        if ($q = $request->get('q')) {
            $query->where('question_text', 'like', '%'.$q.'%');
        }

        if ($request->filled('topics')) {
            $topics = $request->input('topics');
            if (!is_array($topics)) $topics = [$topics];
            $query->whereIn('topic', $topics);
        } elseif ($request->filled('topic')) {
            $query->where('topic', $request->input('topic'));
        }

        $items = $query->inRandomOrder()->limit(10)->get();

        return view('quizjavascript.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quizjavascript.create');
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

        QuizJavascript::create($data);

        return redirect()->route('quizjavascript.index')->with('success', 'Tạo câu hỏi thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuizJavascript $quiz)
    {
        return view('quizjavascript.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuizJavascript $quiz)
    {
        return view('quizjavascript.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuizJavascript $quiz)
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

        return redirect()->route('quizjavascript.index')->with('success', 'Cập nhật câu hỏi thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuizJavascript $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizjavascript.index')->with('success', 'Xóa câu hỏi thành công.');
    }

    /**
     * Submit the quiz answers.
     */
    public function submit(Request $request)
    {
        // --- Lấy dữ liệu & Chấm điểm ---
        $answers = $request->input('answers', []);
        $allQuestionIds = explode(',', $request->input('question_ids'));
        $totalQuestions = count($allQuestionIds);
        $questions = QuizJavascript::whereIn('id', $allQuestionIds)->get();

        $correctAnswersCount = 0;
        foreach ($questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] === $question->correct_answer) {
                $correctAnswersCount++;
            }
        }
        $score = $correctAnswersCount * 10;
        $max_score = $totalQuestions * 10;

        // --- Lưu điểm, lịch sử và HUY HIỆU ---
        $user = Auth::user();
        $newBadges = []; // Khởi tạo mảng huy hiệu mới
        if ($user) {
            // Cộng dồn tổng điểm
            $userScore = Score::firstOrCreate(['user_id' => $user->id]);
            $userScore->score += $score;
            $userScore->save();

            // Lưu lịch sử lần làm bài này
            QuizAttempt::create([
                'user_id'   => $user->id,
                'quiz_type' => 'javascript',
                'score'     => $score,
                'max_score' => $max_score,
                'answers'   => $answers,
                'passed'    => ($score >= $max_score / 2),
            ]);

            // === BỔ SUNG PHẦN LƯU HUY HIỆU ===
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
            // ===================================
        }

        // --- Chuẩn bị dữ liệu chi tiết để hiển thị ---
        $results = [];
        foreach ($questions as $question) {
            $results[] = [
                'question_text'  => $question->question_text,
                'options'        => ['a' => $question->option_a, 'b' => $question->option_b, 'c' => $question->option_c, 'd' => $question->option_d],
                'correct_answer' => $question->correct_answer,
                'selected'       => $answers[$question->id] ?? null,
            ];
        }

        // --- Trả về view kết quả chi tiết ---
        return view('quizjavascript.submit', [
            'score'   => $score,
            'total'   => $max_score,
            'results' => $results,
            'newBadges' => $newBadges, // Gửi huy hiệu mới nhận được sang view
        ]);
    }
}
