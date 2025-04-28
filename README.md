
# 📄 CV & Cover Letter Generator

This is a full-stack web application that allows users to generate professional CVs and cover letters in PDF format. It features a responsive frontend, real-time preview, and a backend PDF generation service using Laravel and DomPDF.

![CV Generator Demo](https://media.giphy.com/media/08AtjJVKoPzcVNGGFJ/giphy.gif)

## 🚀 Features

- 📝 Fill out a simple form with your personal data
- 🖼️ Live preview of the CV while editing
- 📄 Generate high-quality PDF versions of the CV and cover letter
- 🌙 Dark mode UI for a smooth user experience
- 🧪 Unit & Feature tests included (PHPUnit)
- 🐳 Fully Dockerized, works locally or in production
- 🌐 Frontend deployed on GitHub Pages
- 🔙 Backend deployed on Render

## 🛠️ Tech Stack

**Frontend:**
- React
- Tailwind CSS
- Axios
- GitHub Pages for deployment

**Backend:**
- Laravel (PHP 8)
- DomPDF for PDF rendering
- SQLite database
- Render.com deployment
- Docker + Kubernetes (optional setup)

## 📦 Installation

### 1. Clone the repository
```bash
git clone https://github.com/AnatolyBystrov/cvproject.git
cd cvproject
```

### 2. Start the backend (Laravel)
```bash
cd backend
cp .env.example .env
php artisan key:generate
php artisan serve
```
Or using Docker:
```bash
docker build -t cv-backend .
docker run -p 8000:8000 cv-backend
```

### 3. Start the frontend (React)
```bash
cd frontend
npm install
npm start
```
App will be available at: `http://localhost:3000`

## 💡 Usage

1. Fill in your details on the left.
2. Preview your CV on the right.
3. Click `Generate CV PDF` — a PDF will be generated and downloaded.
4. Try API via curl:
```bash
curl -X POST http://localhost:8000/api/generate   -H "Content-Type: application/json"   -d '{
    "name": "Anatoly Bystrov",
    "position": "Full Stack Developer",
    "experience": "GoTo Global Mobility, 2 years",
    "education": "Bоженька",
    "skills": "Laravel, React, Docker, Kubernetes",
    "hobbies": "Running, Programming, Давидушка",
    "cover_letter": "Dear Recruiter, I’m interested in this position because I can do everything."
  }' --output output.pdf
```

## ✅ Running Tests
```bash
php artisan test
```

## 🌍 Live Deployment

- **Frontend**: [Live Demo](https://anatolybystrov.github.io/cvproject/)
- **Backend**: [Render Deployment](https://cvproject-g1yv.onrender.com)

> Note: For AI cover letter generation, you can extend the backend and connect an OpenAI key or Gemini API.

## 📁 Project Structure
```
cvproject/
├── backend/
│   ├── app/Http/Controllers/
│   ├── resources/views/pdf/cv.blade.php
│   ├── routes/api.php
│   └── Dockerfile
└── frontend/
    ├── src/App.jsx
    ├── public/
    └── package.json
```

## ✍️ Author

**Anatoly Bystrov**  
👨‍💻 [GitHub Profile](https://github.com/AnatolyBystrov) | 🇮🇱 Tel Aviv / 🛫 Dubai-ready

## 📜 License

This project is licensed under the MIT License.

---
> If you liked the project, feel free to ⭐ star it on GitHub or share it!
