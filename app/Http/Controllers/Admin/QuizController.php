<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Hiển thị danh sách câu hỏi.
     */
    public function index(Request $request)
    {
        $query = Quiz::query();

        if ($q = $request->get('q')) {
            $query->where('question_text', 'like', '%'.$q.'%');
        }

        $items = $query->orderBy('id', 'desc')->paginate(25)->withQueryString();

        return view('admin.quiz.index', compact('items'));
    }

    /**
     * Hiển thị form tạo câu hỏi mới.
     */
    public function create()
    {
        return view('admin.quiz.create');
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
        if (Quiz::where('question_text', $data['question_text'])->exists()) {
            return redirect()->route('admin.quiz.index')
                ->with('error', 'Câu hỏi này đã tồn tại!');
        }

        Quiz::create($data);

        return redirect()->route('admin.quiz.index')->with('success', 'Tạo câu hỏi thành công.');
    }

    /**
     * Hiển thị chi tiết câu hỏi.
     */
    public function show(Quiz $quiz)
    {
        return view('admin.quiz.show', compact('quiz'));
    }

    /**
     * Hiển thị form chỉnh sửa câu hỏi.
     */
    public function edit(Quiz $quiz)
    {
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Cập nhật câu hỏi.
     */
    public function update(Request $request, Quiz $quiz)
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

        return redirect()->route('admin.quiz.index')->with('success', 'Cập nhật câu hỏi thành công.');
    }

    /**
     * Xóa câu hỏi.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quiz.index')->with('success', 'Xóa câu hỏi thành công.');
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
            if (DB::table('quiz_questions')->where('question_text', $row[0])->exists()) continue;

            DB::table('quiz_questions')->insert([
                'question_text' => $row[0],
                'option_a' => $row[1],
                'option_b' => $row[2],
                'option_c' => $row[3],
                'option_d' => $row[4],
                'correct_answer' => $row[5],
            ]);
        }

        return redirect()->route('quiz.index')->with('success', 'Upload file thành công!');
    }
}
