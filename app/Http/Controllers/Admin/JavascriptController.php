<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Javascript;

class JavascriptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $javascript = Javascript::all();
        return view('admin.javascript', compact('javascript'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.javascript.create');
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
        Javascript::create($validated);
        return redirect()->route('admin.javascript.index')->with('success', 'Thêm bài học Javascript thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Javascript $javascript)
    {
        return view('admin.javascript.show', compact('javascript'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Javascript $javascript)
    {
        return view('admin.javascript.edit', compact('javascript'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Javascript $javascript)
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
        $javascript->update($validated);
        return redirect()->route('admin.javascript.index')->with('success', 'Cập nhật bài học Javascript thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Javascript $javascript)
    {
        $javascript->delete();
        return redirect()->route('admin.javascript.index')->with('success', 'Xóa bài học Javascript thành công!');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        $handle = fopen($path, 'r');
        $header = fgetcsv($handle);

        $rowCount = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            Javascript::create([
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

        return redirect()->route('admin.javascript.index')->with('success', "Đã nhập $rowCount bài học từ file CSV!");
    }
}
