import React, { useState } from 'react';
import PreviewCard from './PreviewCard';
import './index.css';

function App() {
  const API_URL = 'https://cvproject-g1yv.onrender.com';

  const [formData, setFormData] = useState({
    name: '',
    position: '',
    experience: '',
    education: '',
    skills: '',
    hobbies: '',
    cover_letter: '',
  });

  const [darkMode, setDarkMode] = useState(false);
  const toggleTheme = () => setDarkMode(!darkMode);

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const generateCoverLetterPDF = async () => {
    const form = new FormData();
    Object.entries(formData).forEach(([key, value]) => form.append(key, value));

    try {
      const res = await fetch(`${API_URL}/api/generate-cover-letter`, {
        method: 'POST',
        body: form,
      });

      if (!res.ok) throw new Error("PDF generation failed");

      const blob = await res.blob();
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement("a");
      a.href = url;
      a.download = "cover_letter.pdf";
      a.click();
      window.URL.revokeObjectURL(url);
    } catch (err) {
      console.error("❌ Error generating cover letter:", err);
      alert("An error occurred. Try again later.");
    }
  };

  const generateCoverLetterAI = async () => {
    try {
      const form = new FormData();
      Object.entries(formData).forEach(([key, value]) => form.append(key, value));
  
      const response = await fetch(`${API_URL}/api/generate-cover-letter-text`, {
        method: 'POST',
        body: form,
      });
  
      const data = await response.json();
      if (response.ok && data.cover_letter) {
        setFormData(prev => ({ ...prev, cover_letter: data.cover_letter }));
      } else {
        alert('⚠️ Could not generate cover letter.');
      }
    } catch (err) {
      console.error("💥 AI error:", err);
      alert("An error occurred. Try again later.");
    }
  };
  

  const handleSubmit = async (e) => {
    e.preventDefault();

    const form = new FormData();
    for (const key in formData) {
      form.append(key, formData[key]);
    }

    try {
      const response = await fetch(`${API_URL}/api/generate`, {
        method: 'POST',
        body: form,
        headers: {
          'Accept': 'application/json'
        }
      });

      const contentType = response.headers.get('content-type') || '';
      const debugText = await response.clone().text();
      console.log('📄 Response Preview:\n', debugText.slice(0, 300));

      if (response.ok && contentType.includes('application/pdf')) {
        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'cv.pdf';
        a.click();
        window.URL.revokeObjectURL(url);

        setFormData({
          name: '',
          position: '',
          experience: '',
          education: '',
          skills: '',
          hobbies: '',
          cover_letter: '',
        });
      } else {
        throw new Error('❌ Backend did not return a valid PDF');
      }
    } catch (error) {
      console.error('🚨 Error generating CV:', error);
      alert('An error occurred. Try again later.');
    }
  };

  return (
    <div className={`${darkMode ? 'dark' : ''}`}>
      <div className="min-h-screen bg-gradient-to-r from-purple-100 to-blue-100 dark:from-gray-900 dark:to-gray-800 text-gray-900 dark:text-gray-100 transition-all duration-500">
        <div className="p-4 flex justify-between items-center max-w-6xl mx-auto">
          <h1 className="text-3xl font-bold">📝 CV Generator</h1>
          <button
            onClick={toggleTheme}
            className="bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded hover:bg-gray-300 dark:hover:bg-gray-600"
          >
            {darkMode ? '☀️ Light Mode' : '🌙 Dark Mode'}
          </button>
        </div>

        <div className="grid md:grid-cols-2 gap-8 p-4 max-w-6xl mx-auto">
          <form onSubmit={handleSubmit} className="space-y-4 bg-white dark:bg-gray-900 bg-opacity-80 dark:bg-opacity-70 p-6 rounded-xl shadow">
            {Object.entries(formData).map(([field, value]) => (
              <div key={field}>
                <label className="block font-semibold mb-1 capitalize">{field.replace('_', ' ')}</label>
                {field === 'cover_letter' ? (
                  <>
                    <textarea
                      name={field}
                      value={value}
                      onChange={handleChange}
                      placeholder="Write or paste your cover letter"
                      className="w-full p-2 rounded border focus:outline-none focus:ring-2 focus:ring-purple-400 dark:bg-gray-800 dark:border-gray-700"
                      rows={4}
                    />
                    <div className="flex gap-2 mt-1">
                      <button
                        type="button"
                        onClick={generateCoverLetterPDF}
                        className="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm"
                      >
                        💌 Download as PDF
                      </button>
                      <button
                        type="button"
                        onClick={generateCoverLetterAI}
                        className="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-sm"
                      >
                        ✨ Generate AI Text
                      </button>
                    </div>
                  </>
                ) : (
                  <input
                    type="text"
                    name={field}
                    value={value}
                    onChange={handleChange}
                    placeholder={`Enter your ${field}`}
                    className="w-full p-2 rounded border focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-800 dark:border-gray-700"
                  />
                )}
              </div>
            ))}
            <button
              type="submit"
              className="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition"
            >
              📄 Generate CV PDF
            </button>
          </form>

          <PreviewCard formData={formData} />
        </div>
      </div>
    </div>
  );
}

export default App;
