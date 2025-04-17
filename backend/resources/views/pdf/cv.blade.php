<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CV PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { color: #6366f1; }
    </style>
</head>
<body>
    <h1>{{ $name }}</h1>
    <p><strong>Position:</strong> {{ $position }}</p>
    <p><strong>Experience:</strong> {{ $experience }}</p>
    <p><strong>Education:</strong> {{ $education }}</p>
    <p><strong>Skills:</strong> {{ $skills }}</p>
    <p><strong>Hobbies:</strong> {{ $hobbies }}</p>
    <p><strong>Cover Letter:</strong><br>{{ $cover_letter }}</p>
</body>
</html>
