<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizJavascript;

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
        $answers = $request->input('answers', []);
        $questions = QuizJavascript::whereIn('id', array_keys($answers))->get();

        $score = 0;
        $total = $questions->count();
        $results = [];

        foreach ($questions as $q) {
            $selected = $answers[$q->id] ?? null;
            if ($selected == $q->correct_answer) $score++;
            $results[] = [
                'question_text' => $q->question_text,
                'options' => [
                    'a' => $q->option_a,
                    'b' => $q->option_b,
                    'c' => $q->option_c,
                    'd' => $q->option_d,
                ],
                'correct_answer' => $q->correct_answer,
                'selected' => $selected,
            ];
        }

        return view('quizjavascript.submit', compact('score', 'total', 'results'));
    }
}
