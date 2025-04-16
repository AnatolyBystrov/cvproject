# CV & Cover Letter Generator 📝✨

A web-based tool that helps users generate a polished CV and cover letter in PDF format.  
This project features a professional React frontend and a Laravel backend with optional AI-enhanced cover letter support.

## 🔥 Features

- Dynamic form for user input (name, skills, education, etc.)
- Live preview of the CV card before generating the PDF
- AI-generated cover letter (optional)
- Fallback mock cover letter if API key is missing
- PDF generation and download
- Fully containerized with Docker
- Unit & Feature tests for the backend

## 📦 Tech Stack

- **Frontend**: React, Tailwind CSS
- **Backend**: Laravel 10, DomPDF
- **Docker**: Multi-container setup (Nginx, PHP, Node)
- **Testing**: PHPUnit
- **Optional**: OpenAI API for AI-powered cover letters

## 🚀 Getting Started

### Prerequisites

- Docker + Docker Compose
- (Optional) OpenAI API key

### 🐳 Run with Docker

```bash
docker compose up --build
```

- React App: http://localhost:3000  
- Laravel API: http://localhost:8000

### 🧠 Add your AI Key (optional)

To enable the AI-generated cover letter, add your OpenAI API key in `.env`:

```env
OPENAI_API_KEY=sk-xxxxxx
```

If not set, the system will generate a mock cover letter.

## 🧪 Running Tests

```bash
cd backend
php artisan test
```

Includes feature tests for:
- PDF generation with valid data
- Validation errors for missing fields
- Special character handling

## 📁 Project Structure

```
📦cvproject
 ┣ 📂backend
 ┃ ┣ 📂app/Http/Controllers
 ┃ ┣ 📂routes/api.php
 ┃ ┣ 📂resources/views/pdf/cv.blade.php
 ┃ ┣ 📂tests/Feature/Http/Controllers/GenerateControllerTest.php
 ┣ 📂frontend
 ┃ ┣ 📂src/PreviewCard.js
 ┃ ┗ 📂...
 ┣ 📄docker-compose.yml
 ┣ 📄README.md
```

## 👨‍💻 Author

Made with ❤️ by Anatoly Bystrov  
Reach out: [LinkedIn](https://www.linkedin.com/in/anatolybystrov)