import React, { useState } from 'react';
import './index.css'; // Убедись, что ты используешь Tailwind здесь

function App() {
  const [formData, setFormData] = useState({
    name: '',
    position: '',
    experience: '',
    education: '',
    skills: '',
    hobbies: ''
  });

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const form = new FormData();
    Object.entries(formData).forEach(([key, value]) => form.append(key, value));

    try {
      const response = await fetch('http://localhost:8000/api/generate', {
        method: 'POST',
        body: form
      });

      if (!response.ok) {
        alert('❌ Failed to generate CV. Please check your server.');
        return;
      }

      const blob = await response.blob();
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'cv.pdf';
      a.click();

      // ✅ Сброс формы
      setFormData({
        name: '',
        position: '',
        experience: '',
        education: '',
        skills: '',
        hobbies: ''
      });
    } catch (error) {
      console.error('Error generating CV:', error);
      alert('🚨 An error occurred. Try again later.');
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center px-4">
      <div className="bg-white shadow-xl rounded-xl p-10 w-full max-w-lg">
        <h1 className="text-3xl font-bold text-center text-gray-800 mb-8">📝 CV Generator</h1>
        <form onSubmit={handleSubmit} className="space-y-4">
          {Object.keys(formData).map((field) => (
            <div key={field}>
              <label className="block text-sm font-semibold text-gray-600 capitalize mb-1">
                {field}
              </label>
              <input
                type="text"
                name={field}
                value={formData[field]}
                onChange={handleChange}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder={`Enter your ${field}`}
              />
            </div>
          ))}
          <button
            type="submit"
            className="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition duration-300"
          >
            🚀 Generate CV
          </button>
        </form>
      </div>
    </div>
  );
}

export default App;
