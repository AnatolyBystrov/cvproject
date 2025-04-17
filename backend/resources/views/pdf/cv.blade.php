<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CV</title>
    <style>
        body { font-family: sans-serif; line-height: 1.5; }
        h1 { font-size: 24px; margin-bottom: 10px; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>{{ $name }}</h1>
    <p><strong>Position:</strong> {{ $position }}</p>
    <p><strong>Experience:</strong> {{ $experience }}</p>
    <p><strong>Education:</strong> {{ $education }}</p>
    <p><strong>Skills:</strong> {{ $skills }}</p>
    <p><strong>Hobbies:</strong> {{ $hobbies }}</p>
    <hr>
    <h2>Cover Letter</h2>
    <p>{!! nl2br(e($cover_letter)) !!}</p>
</body>
</html>
