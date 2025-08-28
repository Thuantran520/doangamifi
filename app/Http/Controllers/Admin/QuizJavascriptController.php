<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizJavascript;
use Illuminate\Support\Facades\DB;

class QuizJavascriptController extends Controller
{
    /**
     * Hiển thị danh sách câu hỏi.
     */
    public function index(Request $request)
    {
        $query = QuizJavascript::query();

        if ($q = $request->get('q')) {
            $query->where('question_text', 'like', '%'.$q.'%');
        }

        $items = $query->orderBy('id', 'desc')->paginate(25)->withQueryString();

        return view('admin.quizjavascript.index', compact('items'));
    }

    /**
     * Hiển thị form tạo câu hỏi mới.
     */
    public function create()
    {
        return view('admin.quizjavascript.create');
    }

    /**
     * Lưu câu hỏi mới vào DB.
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
            'difficulty'     => 'nullable|string',
            'topic'          => 'nullable|string',
        ]);

        if (QuizJavascript::where('question_text', $data['question_text'])->exists()) {
            return redirect()->route('admin.quizjavascript.index')
                ->with('error', 'Câu hỏi này đã tồn tại!');
        }

        QuizJavascript::create($data);

        return redirect()->route('admin.quizjavascript.index')->with('success', 'Tạo câu hỏi thành công.');
    }

    /**
     * Hiển thị chi tiết câu hỏi.
     */
    public function show(\App\Models\QuizJavascript $quizjavascript)
    {
        $quiz = $quizjavascript;
        return view('admin.quizjavascript.show', compact('quiz'));
    }

    /**
     * Hiển thị form chỉnh sửa câu hỏi.
     */
    public function edit(\App\Models\QuizJavascript $quizjavascript)
    {
        $quiz = $quizjavascript;
        return view('admin.quizjavascript.edit', compact('quiz'));
    }

    /**
     * Cập nhật câu hỏi.
     */
    public function update(Request $request, \App\Models\QuizJavascript $quizjavascript)
    {
        $data = $request->only([
            'question_text', 'option_a', 'option_b', 'option_c', 'option_d',
            'correct_answer', 'difficulty', 'topic'
        ]);

        $quizjavascript->update($data);

        return redirect()->route('admin.quizjavascript.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Xóa câu hỏi.
     */
    public function destroy(\App\Models\QuizJavascript $quizjavascript)
    {
        $quizjavascript->delete();
        return redirect()->route('admin.quizjavascript.index')->with('success', 'Xóa thành công');
    }

    /**
     * Tải lên file câu hỏi.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'quiz_file' => 'required|file|mimes:csv,txt,xlsx,xls',
        ]);

        $file = $request->file('quiz_file');
        $path = $file->getRealPath();

        $rows = array_map('str_getcsv', file($path));
        foreach (array_slice($rows, 1) as $row) {
            if (count($row) < 6) continue;

            if (DB::table('quiz_javascript')->where('question_text', $row[0])->exists()) continue;

            DB::table('quiz_javascript')->insert([
                'question_text' => $row[0],
                'option_a' => $row[1],
                'option_b' => $row[2],
                'option_c' => $row[3],
                'option_d' => $row[4],
                'correct_answer' => $row[5],
                'difficulty' => $row[6] ?? null,
                'topic' => $row[7] ?? null,
            ]);
        }

        return redirect()->route('admin.quizjavascript.index')->with('success', 'Upload file thành công!');
    }
}
