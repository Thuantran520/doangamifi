<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cpp;

class CppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cpp = Cpp::all();
        return view('admin.cpp', compact('cpp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cpp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'example' => 'nullable|string',
            'topic' => 'nullable|string',
            'order' => 'nullable|integer',
            'created_at' => 'nullable|date_format:Y-m-d',
        ]);
        Cpp::create($validated);
        return redirect()->route('admin.cpp.index')->with('success', 'Thêm bài học C++ thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cpp $cpp)
    {
        return view('admin.cpp.show', compact('cpp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cpp $cpp)
    {
        return view('admin.cpp.edit', compact('cpp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cpp $cpp)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'example' => 'nullable|string',
            'topic' => 'nullable|string',
            'order' => 'nullable|integer',
            'updated_date' => 'nullable|date_format:Y-m-d',
        ]);
        $cpp->update($validated);
        return redirect()->route('admin.cpp.index')->with('success', 'Cập nhật bài học C++ thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cpp $cpp)
    {
        $cpp->delete();
        return redirect()->route('admin.cpp.index')->with('success', 'Xóa bài học C++ thành công!');
    }
    public function upload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        $handle = fopen($path, 'r');
        $header = fgetcsv($handle); // Lấy dòng đầu tiên làm header

        // Ví dụ: header gồm title, content, example, topic, order, created_at
        $rowCount = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            // Tùy file CSV, bạn có thể cần đổi tên cột cho đúng
            Cpp::create([
                'title'      => $data['title'] ?? '',
                'content'    => $data['content'] ?? '',
                'example'    => $data['example'] ?? '',
                'topic'      => $data['topic'] ?? '',
                'order'      => $data['order'] ?? null,
                'created_at' => $data['created_at'] ?? now(),
            ]);
            $rowCount++;
        }
        fclose($handle);

        return redirect()->route('admin.cpp.index')->with('success', "Đã nhập $rowCount bài học từ file CSV!");
    }
}
