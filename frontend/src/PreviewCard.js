import React from 'react';

const PreviewCard = ({ formData }) => {
  return (
    <div className="bg-white bg-opacity-70 backdrop-blur-lg shadow-lg rounded-xl p-6 text-gray-800 space-y-4">
      <h2 className="text-2xl font-bold border-b pb-2"> CV Preview</h2>

      <div>
        <strong>Name:</strong>{' '}
        {formData.name ? formData.name : <span className="text-gray-400">[Your Name]</span>}
      </div>

      <div>
        <strong>Position:</strong>{' '}
        {formData.position ? formData.position : <span className="text-gray-400">[Position]</span>}
      </div>

      <div>
        <strong>Experience:</strong>
        <p>{formData.experience ? formData.experience : <span className="text-gray-400">[No Experience]</span>}</p>
      </div>

      <div>
        <strong>Education:</strong>
        <p>{formData.education ? formData.education : <span className="text-gray-400">[No Education]</span>}</p>
      </div>

      <div>
        <strong>Skills:</strong>
        <p>{formData.skills ? formData.skills : <span className="text-gray-400">[No Skills]</span>}</p>
      </div>

      <div>
        <strong>Hobbies:</strong>
        <p>{formData.hobbies ? formData.hobbies : <span className="text-gray-400">[No Hobbies]</span>}</p>
      </div>

      <div>
        <strong>Cover Letter:</strong>
        <p>{formData.cover_letter ? formData.cover_letter : <span className="text-gray-400">[No Cover Letter]</span>}</p>
      </div>

      <hr className="border-gray-300 my-4" />

      {/* Debug output */}
      <details>
        <summary className="text-sm text-purple-700 cursor-pointer"> Debug formData</summary>
        <pre className="text-xs text-gray-600 bg-gray-100 p-2 rounded">{JSON.stringify(formData, null, 2)}</pre>
      </details>
    </div>
  );
};

export default PreviewCard;
