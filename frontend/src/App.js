import React, { useState } from 'react';
import './index.css';
import PreviewCard from './PreviewCard';

function App() {
  const [formData, setFormData] = useState({
    name: '',
    position: '',
    experience: '',
    education: '',
    skills: '',
    hobbies: '',
    cover_letter: ''
  });

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const generateCoverLetter = () => {

    const fakeLetter = `Dear Hiring Manager,

I'm thrilled to apply for the position of ${formData.position || 'Developer'} at your company. With experience in ${formData.experience || 'various tech domains'} and a passion for innovation, I'm confident I can contribute meaningfully.

Sincerely,  
${formData.name || 'John Doe'}`;

    setFormData(prev => ({ ...prev, cover_letter: fakeLetter }));
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
        alert('❌ Failed to generate CV PDF. Please check your server.');
        return;
      }

      const blob = await response.blob();
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'cv.pdf';
      a.click();

      setFormData({
        name: '',
        position: '',
        experience: '',
        education: '',
        skills: '',
        hobbies: '',
        cover_letter: ''
      });
    } catch (error) {
      console.error('Error generating CV:', error);
      alert('🚨 An error occurred. Try again later.');
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-r from-blue-200 to-purple-300 flex items-start justify-center p-10">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-6xl w-full">
        
        {/* Form block */}
        <div className="bg-white bg-opacity-70 backdrop-blur-lg shadow-xl rounded-xl p-8">
          <h1 className="text-3xl font-bold text-center text-gray-800 mb-6">📝 CV Generator</h1>
          <form onSubmit={handleSubmit} className="space-y-4">
            {Object.entries(formData).map(([field, value]) => (
              <div key={field}>
                <label className="block text-sm font-semibold text-gray-700 capitalize mb-1">
                  {field.replace('_', ' ')}
                </label>
                {field === 'cover_letter' ? (
                  <>
                    <textarea
                      name={field}
                      value={value}
                      onChange={handleChange}
                      className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 h-32 resize-none"
                      placeholder="Write your cover letter here..."
                    />
                    <button
                      type="button"
                      onClick={generateCoverLetter}
                      className="mt-2 text-sm text-blue-600 underline hover:text-blue-800 transition"
                    >
                      ✨ Generate Cover Letter with AI (Demo)
                    </button>
                  </>
                ) : (
                  <input
                    type="text"
                    name={field}
                    value={value}
                    onChange={handleChange}
                    className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder={`Enter your ${field}`}
                  />
                )}
              </div>
            ))}
            <button
              type="submit"
              className="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded-lg transition duration-300"
            >
              🚀 Generate CV PDF
            </button>
          </form>
        </div>

        {/* Preview block */}
        <PreviewCard formData={formData} />
      </div>
    </div>
  );
}

export default App;
