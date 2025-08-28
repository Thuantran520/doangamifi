<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Làm bài trắc nghiệm JavaScript</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h2 class="mb-4">Làm bài trắc nghiệm JavaScript</h2>

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
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Câu {{ $loop->iteration }}: {{ $item->question_text }}</h5>
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
                                <strong>{{ strtoupper($opt) }}.</strong> {{ $text }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button class="btn btn-success" type="submit">Nộp bài</button>
    </form>

    <a href="{{ route('launcher') }}" class="btn btn-secondary mt-3"
       onclick="return confirm('Bạn có chắc chắn muốn quay về trang chủ? Mọi dữ liệu làm bài sẽ bị mất!');">
        Quay về trang chủ
    </a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>