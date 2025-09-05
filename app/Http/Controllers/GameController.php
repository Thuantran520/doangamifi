<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Badge;
use App\Models\QuizAttempt; // đảm bảo đã use
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Dùng HTTP Client của Laravel

class GameController extends Controller
{
    public function completeChallenge(Request $request)
    {
        $user = Auth::user();
        $points = $request->input('points', 0);

        // Cộng điểm cho user
        $userScore = $user->score()->firstOrCreate(
            ['user_id' => $user->id],
            ['score' => 0]
        );
        $userScore->increment('score', $points);

        // Kiểm tra điều kiện tặng badge
        if ($userScore->score >= 1000) {
            $badge = Badge::where('name', 'Medal Vàng')->first();
            if ($badge && !$user->badges->contains($badge->id)) {
                $user->badges()->attach($badge->id);
            }
        }

        return redirect()->back()->with('success', 'Bạn đã nhận được điểm!');
    }

    public function robotControl()
    {
        return view('games.robot-control');
    }

    public function runRobotCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'language_id' => 'required|integer',
        ]);

        // Chuẩn bị dữ liệu để gửi đến Judge0
        // Bạn cần thêm input cho game robot vào đây nếu cần
        $sourceCode = $request->input('code');
        $languageId = $request->input('language_id');

        // Gọi API của Judge0
        $response = Http::post('https://judge0-ce.p.rapidapi.com/submissions?base64_encoded=false&wait=true', [
            'source_code' => $sourceCode,
            'language_id' => $languageId,
            // 'stdin' => 'dữ liệu đầu vào cho game nếu có'
        ], [
            'X-RapidAPI-Host' => 'judge0-ce.p.rapidapi.com',
            'X-RapidAPI-Key' => env('JUDGE0_API_KEY'), // <-- Lưu API Key trong file .env
            'Content-Type' => 'application/json',
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Không thể kết nối đến dịch vụ thực thi code.'], 500);
        }

        $result = $response->json();

        // Xử lý kết quả từ Judge0
        if ($result['status']['description'] === 'Accepted') {
            return response()->json(['output' => $result['stdout']]);
        } else {
            // Trả về lỗi biên dịch hoặc lỗi runtime
            $error_message = $result['stderr'] ?? $result['compile_output'] ?? 'Lỗi không xác định.';
            return response()->json(['error' => base64_decode($error_message)]);
        }
    }

    public function addRobotScore(Request $request)
    {
        $request->validate([
            'score' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Người dùng chưa đăng nhập.'], 401);
        }

        $scoreToAdd = $request->input('score');

        // Tìm bản ghi điểm của người dùng, hoặc tạo mới nếu chưa có.
        $userScore = Score::firstOrCreate(
            ['user_id' => $user->id],
            ['score' => 0]
        );

        // Cộng điểm và lưu lại
        $userScore->score += $scoreToAdd;
        $userScore->save();

        return response()->json([
            'success' => true,
            'message' => 'Cộng điểm thành công!',
            'newTotalScore' => $userScore->score
        ]);
    }

    public function sortChallenge()
    {
        // Sinh mảng random (client cũng có thể tự sinh, nhưng gửi sẵn để đồng bộ)
        $array = collect(range(1,8))
            ->shuffle()
            ->take(6) // 6 phần tử cho nhẹ
            ->values()
            ->all();

        return view('games.sort-challenge', [
            'initialArray' => $array
        ]);
    }

    public function submitSortChallenge(Request $request)
    {
        $request->validate([
            'original' => 'required|array',
            'result' => 'required|array',
            'log' => 'required|array',
            'ops' => 'required|integer|min:0',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Chưa đăng nhập'], 401);
        }

        $original = $request->input('original');
        $result = $request->input('result');
        $log = $request->input('log');
        $ops = (int)$request->input('ops');

        // Kiểm tra có phải hoán vị hợp lệ của mảng gốc không
        if (count($original) !== count($result) ||
            collect($original)->sort()->values()->toArray() !== collect($result)->sort()->values()->toArray()) {
            return response()->json(['success' => false, 'message' => 'Kết quả không hợp lệ'], 422);
        }

        // Kiểm tra đã được sắp xếp tăng dần
        $sorted = $result;
        $isSorted = true;
        for ($i=1;$i<count($sorted);$i++){
            if ($sorted[$i-1] > $sorted[$i]) {
                $isSorted = false;
                break;
            }
        }

        if (!$isSorted) {
            $scoreToAdd = 0;
            $statusText = 'Chưa sắp xếp đúng';
        } else {
            // Công thức điểm: tối đa 30 - (ops - (n*log2 n) gần đúng)
            $n = count($result);
            $ideal = (int)round($n * log($n, 2)); // xấp xỉ
            $raw = 30 - max(0, $ops - $ideal);
            $scoreToAdd = max(5, min(30, $raw)); // đảm bảo 5..30
            $statusText = 'Hoàn thành';
        }

        // Cộng điểm nếu > 0
        if ($scoreToAdd > 0) {
            $userScore = Score::firstOrCreate(
                ['user_id' => $user->id],
                ['score' => 0]
            );
            $userScore->score += $scoreToAdd;
            $userScore->save();
        }

        // Lưu lịch sử
        QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_name' => 'Game Sort Challenge',
            'score' => $scoreToAdd,
            'total_questions' => 1,
            'details' => json_encode([
                'original' => $original,
                'result' => $result,
                'operations' => $ops,
                'log' => $log,
                'status' => $statusText,
            ]),
            'passed' => $isSorted,
        ]);

        return response()->json([
            'success' => true,
            'message' => $statusText,
            'added' => $scoreToAdd,
            'newTotalScore' => $user->score->score ?? 0
        ]);
    }
}
