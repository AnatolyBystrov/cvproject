
import React from 'react';

const PreviewCard = ({ formData }) => {
  return (
    <div className="bg-white bg-opacity-70 backdrop-blur-lg shadow-lg rounded-xl p-6 text-gray-800 space-y-4">
      <h2 className="text-2xl font-bold border-b pb-2">📄 CV Preview</h2>
      <div>
        <strong>Name:</strong> {formData.name || <span className="text-gray-400">[Your Name]</span>}
      </div>
      <div>
        <strong>Position:</strong> {formData.position || <span className="text-gray-400">[Position]</span>}
      </div>
      {formData.experience && (
        <div>
          <strong>Experience:</strong>
          <p>{formData.experience}</p>
        </div>
      )}
      {formData.education && (
        <div>
          <strong>Education:</strong>
          <p>{formData.education}</p>
        </div>
      )}
      {formData.skills && (
        <div>
          <strong>Skills:</strong>
          <p>{formData.skills}</p>
        </div>
      )}
      {formData.hobbies && (
        <div>
          <strong>Hobbies:</strong>
          <p>{formData.hobbies}</p>
        </div>
      )}
      {formData.cover_letter && (
        <div>
          <strong>Cover Letter:</strong>
          <p>{formData.cover_letter}</p>
        </div>
      )}
    </div>
  );
};

export default PreviewCard;
