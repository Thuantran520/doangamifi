
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Làm bài trắc nghiệm JavaScript</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('quiz.css') }}">
</head>
<body>
<div class="quiz-container">
    <div class="quiz-header">
        <h1><i class="fab fa-js-square"></i> Trắc nghiệm JavaScript</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('quizjavascript.submit') }}">
        @csrf

        @foreach($items as $item)
            <div class="question-card">
                <div class="card-header">
                    Câu {{ $loop->iteration }}
                </div>
                <div class="card-body">
                    <p class="lead">{{ $item->question_text }}</p>
                    @php
                        $options = [
                            'a' => $item->option_a,
                            'b' => $item->option_b,
                            'c' => $item->option_c,
                            'd' => $item->option_d,
                        ];
                    @endphp
                    @foreach($options as $opt => $text)
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="radio"
                                   name="answers[{{ $item->id }}]"
                                   id="q{{ $item->id }}-{{ $opt }}"
                                   value="{{ $opt }}">
                            <label class="form-check-label" for="q{{ $item->id }}-{{ $opt }}">
                                {{ $text }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="quiz-footer">
            <button class="btn btn-success btn-lg" type="submit">Nộp bài</button>
            <a href="{{ route('launcher') }}" class="btn btn-secondary btn-lg mt-3 mt-sm-0"
               onclick="return confirm('Bạn có chắc chắn muốn quay về? Mọi dữ liệu làm bài sẽ bị mất!');">
                Quay về
            </a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>