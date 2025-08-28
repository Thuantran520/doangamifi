<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizPython;
use Illuminate\Support\Facades\DB;

class QuizPythonController extends Controller
{
    /**
     * Hiển thị danh sách câu hỏi.
     */
    public function index(Request $request)
    {
        $query = QuizPython::query();

        if ($q = $request->get('q')) {
            $query->where('question_text', 'like', '%'.$q.'%');
        }

        $items = $query->orderBy('id', 'desc')->paginate(25)->withQueryString();

        return view('admin.quizpython.index', compact('items'));
    }

    /**
     * Hiển thị form tạo câu hỏi mới.
     */
    public function create()
    {
        return view('admin.quizpython.create');
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
        ]);

        // Kiểm tra trùng câu hỏi
        if (QuizPython::where('question_text', $data['question_text'])->exists()) {
            return redirect()->route('admin.quizpython.index')
                ->with('error', 'Câu hỏi này đã tồn tại!');
        }

        QuizPython::create($data);

        return redirect()->route('admin.quizpython.index')->with('success', 'Tạo câu hỏi thành công.');
    }

    /**
     * Hiển thị chi tiết câu hỏi.
     */
    public function show(\App\Models\QuizPython $quizpython)
    {
        // keep view variable name `$quiz` so your views don't need changes
        $quiz = $quizpython;
        return view('admin.quizpython.show', compact('quiz'));
    }

    /**
     * Hiển thị form chỉnh sửa câu hỏi.
     */
    public function edit(\App\Models\QuizPython $quizpython)
    {
        $quiz = $quizpython;
        return view('admin.quizpython.edit', compact('quiz'));
    }

    /**
     * Cập nhật câu hỏi.
     */
    public function update(Request $request, \App\Models\QuizPython $quizpython)
    {
        $data = $request->only([
            'question_text', 'option_a', 'option_b', 'option_c', 'option_d',
            'correct_answer', 'difficulty', 'topic'
        ]);

        $quizpython->update($data);

        return redirect()->route('admin.quizpython.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Xóa câu hỏi.
     */
    public function destroy(\App\Models\QuizPython $quizpython)
    {
        $quizpython->delete();
        return redirect()->route('admin.quizpython.index')->with('success', 'Xóa thành công');
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
            if (count($row) < 6) continue; // Bỏ qua dòng thiếu dữ liệu

            // Kiểm tra trùng câu hỏi
            if (DB::table('quiz_python')->where('question_text', $row[0])->exists()) continue;

            DB::table('quiz_python')->insert([
                'question_text' => $row[0],
                'option_a' => $row[1],
                'option_b' => $row[2],
                'option_c' => $row[3],
                'option_d' => $row[4],
                'correct_answer' => $row[5],
            ]);
        }

        return redirect()->route('admin.quizpython.index')->with('success', 'Upload file thành công!');
    }
}
