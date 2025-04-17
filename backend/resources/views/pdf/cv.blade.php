<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.4;
            font-size: 14px;
        }
        h1 { font-size: 20px; }
        h2 { font-size: 16px; margin-top: 15px; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>{{ $name ?? '' }}</h1>
    <h2>Position:</h2>
    <p>{{ $position ?? '' }}</p>
    <h2>Experience:</h2>
    <p>{{ $experience ?? '' }}</p>
    <h2>Education:</h2>
    <p>{{ $education ?? '' }}</p>
    <h2>Skills:</h2>
    <p>{{ $skills ?? '' }}</p>
    <h2>Hobbies:</h2>
    <p>{{ $hobbies ?? '' }}</p>
    <h2>Cover Letter:</h2>
    <p>{!! nl2br(e($cover_letter ?? '')) !!}</p>
</body>
</html>
