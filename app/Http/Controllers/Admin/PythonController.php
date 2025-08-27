<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Python;

class PythonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $python = Python::all();
        return view('admin.python', compact('python'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.python.create');
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
        Python::create($validated);
        return redirect()->route('admin.python.index')->with('success', 'Thêm bài học thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Python $python)
    {
        return view('admin.python.show', compact('python'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Python $python)
    {
        return view('admin.python.edit', compact('python'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Python $python)
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
        $python->update($validated);
        return redirect()->route('admin.python.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Python $python)
    {
        $python->delete();
        return redirect()->route('admin.python.index')->with('success', 'Xóa thành công!');
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

        $rowCount = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            Python::create([
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

        return redirect()->route('admin.python.index')->with('success', "Đã nhập $rowCount bài học từ file CSV!");
    }
}
