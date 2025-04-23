<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cover Letter</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; line-height: 1.6; }
    h1 { font-size: 24px; margin-bottom: 20px; }
  </style>
</head>
<body>
  <p>Dear Hiring Manager,</p>

  <p>
    I am writing to express my interest in the position of <strong>{{ $position }}</strong> at your company.
    I believe my skills and experience make me a strong candidate for this role.
  </p>

  <p>
    {{ $cover_letter }}
  </p>

  <p>Sincerely,<br>{{ $name }}</p>
</body>
</html>
