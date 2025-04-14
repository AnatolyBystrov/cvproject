<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV - {{ $name }}</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.4;
            margin: 40px;
        }
        h1 {
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }
        h2 {
            margin-top: 30px;
            color: #333;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>{{ $name }}</h1>
    <p><strong>Position:</strong> {{ $position }}</p>

    @if(!empty($experience))
        <h2>Experience</h2>
        <p>{{ $experience }}</p>
    @endif

    @if(!empty($education))
        <h2>Education</h2>
        <p>{{ $education }}</p>
    @endif

    @if(!empty($skills))
        <h2>Skills</h2>
        <p>{{ $skills }}</p>
    @endif

    @if(!empty($hobbies))
        <h2>Hobbies</h2>
        <p>{{ $hobbies }}</p>
    @endif

    @if(!empty($cover_letter))
        <h2>Cover Letter</h2>
        <p>{{ $cover_letter }}</p>
    @endif
</body>
</html>
