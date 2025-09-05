<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Hiển thị trang bảng xếp hạng.
     */
    public function index()
    {
        // Lấy danh sách điểm, sắp xếp giảm dần, và eager load thông tin user
        // Chỉ lấy những user có tồn tại để tránh lỗi
        $topUsers = Score::with('user')
                         ->whereHas('user')
                         ->orderBy('score', 'desc')
                         ->paginate(20); // Phân trang, 20 người/trang

        return view('score', compact('topUsers'));
    }
}
