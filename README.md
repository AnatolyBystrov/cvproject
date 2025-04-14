
# 📝 CV Generator Web App

A beautiful and simple full-stack application that allows users to generate customized **CVs and Cover Letters**, preview them live, and download as PDF.

---

## ✨ Features

- 📋 Form to input:
  - Name
  - Position
  - Experience
  - Education
  - Skills
  - Hobbies
  - Cover Letter (manual or auto-generated with mock AI)

- 🧠 AI Cover Letter button (mock):
  - Generates sample text (OpenAI-ready – insert your own API key)

- 🖨️ PDF Generation:
  - Sends data to backend and generates `cv.pdf`

- 👁️ Live Preview:
  - Realtime update of entered data

- 🎨 Beautiful modern UI:
  - Responsive design with Tailwind CSS
  - Clean, two-column layout

---

## 📁 Project Structure

```
cvproject/
├── backend/         # Laravel API
│   ├── app/Http/Controllers/GenerateController.php
│   ├── routes/api.php
│   ├── ...
├── frontend/        # React + Tailwind
│   ├── App.js
│   ├── PreviewCard.js
│   ├── ...
```

---

## 🚀 Getting Started

### Frontend

```bash
cd frontend
npm install
npm run dev
```

### Backend

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

---

## 🔐 OpenAI API (Optional)

To enable real AI cover letter generation:

1. Create an account at https://platform.openai.com/
2. Generate an API key
3. Set it in `.env` like this:

```env
OPENAI_API_KEY=your-key-here
```

> 💡 The AI is mocked in the current version. To enable real generation, insert your key and call OpenAI API in `AiController`.

---

## 🧪 Testing (optional)

Coming soon...

---

## 📄 License

MIT — Created with ❤️ by **Anatoly Bystrov**
