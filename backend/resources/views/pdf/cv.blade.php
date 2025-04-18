<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $name ?? 'CV' }} - CV</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            font-size: 16px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>{{ $name ?? '' }}</h1>

    @if (!empty($position))
    <div class="section">
        <div class="section-title">Position</div>
        <div>{{ $position }}</div>
    </div>
    @endif

    @if (!empty($experience))
    <div class="section">
        <div class="section-title">Experience</div>
        <div>{{ $experience }}</div>
    </div>
    @endif

    @if (!empty($education))
    <div class="section">
        <div class="section-title">Education</div>
        <div>{{ $education }}</div>
    </div>
    @endif

    @if (!empty($skills))
    <div class="section">
        <div class="section-title">Skills</div>
        <div>{{ $skills }}</div>
    </div>
    @endif

    @if (!empty($hobbies))
    <div class="section">
        <div class="section-title">Hobbies</div>
        <div>{{ $hobbies }}</div>
    </div>
    @endif

    @if (!empty($cover_letter))
    <div class="section">
        <div class="section-title">Cover Letter</div>
        <div>{!! nl2br(e($cover_letter)) !!}</div>
    </div>
    @endif
</body>
</html>
