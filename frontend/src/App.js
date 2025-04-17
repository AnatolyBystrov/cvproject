import React, { useState } from 'react';
import PreviewCard from './PreviewCard';
import './index.css';

function App() {
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

  const generateCoverLetter = () => {
    const fakeLetter = `Dear Hiring Manager,\n\nI am writing to express my interest in the position of ${formData.position || '___'} at your company. I believe my skills and experience make me an ideal candidate for this role.\n\nSincerely,\n${formData.name || 'Your Name'}`;
    setFormData((prev) => ({ ...prev, cover_letter: fakeLetter }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const form = new FormData();
    for (const key in formData) {
      form.append(key, formData[key]);
    }

    const API_URL = process.env.REACT_APP_API_URL || '';
    console.log('🌍 API URL:', API_URL);

    try {
      const response = await fetch(`${API_URL}/api/generate`, {
        method: 'POST',
        body: form,
      });

      const contentType = response.headers.get('content-type');
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
      console.error('Error generating CV:', error);
      alert('🚨 An error occurred. Try again later.');
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
                      placeholder="Write or generate a cover letter..."
                      className="w-full p-2 rounded border focus:outline-none focus:ring-2 focus:ring-purple-400 dark:bg-gray-800 dark:border-gray-700"
                      rows={4}
                    />
                    <button
                      type="button"
                      onClick={generateCoverLetter}
                      className="text-sm text-purple-600 dark:text-purple-300 hover:underline mt-1"
                    >
                      ✨ Generate Cover Letter (demo)
                    </button>
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
