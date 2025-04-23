<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cover Letter</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }
        .container {
            width: 100%;
            padding: 30px;
        }
        .signature {
            margin-top: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <p>{{ $name }}</p>
    <p>{{ date('F j, Y') }}</p>

    <p>Dear Hiring Manager,</p>

    <p>
        I am writing to express my interest in the <strong>{{ $position }}</strong> position.
        With a strong background in {{ $experience }}, I bring a unique combination of skills and
        experiences that make me a perfect fit for this role.
    </p>

    <p>
        My educational background in {{ $education }} and hands-on experience with {{ $skills }}
        allow me to contribute effectively to your team. I am particularly impressed by your company's
        commitment to innovation and excellence.
    </p>

    <p>
        Thank you for considering my application. I would welcome the opportunity to further
        discuss how I can contribute to your team.
    </p>

    <p class="signature">Sincerely,<br>{{ $name }}</p>
</div>
</body>
</html>
