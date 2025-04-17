import React from 'react';

const PreviewCard = ({ formData }) => {
  return (
    <div className="bg-white dark:bg-gray-900 bg-opacity-80 dark:bg-opacity-70 p-6 rounded-xl shadow space-y-4 transition-all duration-500">
      <h2 className="text-2xl font-bold border-b border-gray-300 dark:border-gray-700 pb-2">📄 CV Preview</h2>
      {[
        ['Name', formData.name],
        ['Position', formData.position],
        ['Experience', formData.experience],
        ['Education', formData.education],
        ['Skills', formData.skills],
        ['Hobbies', formData.hobbies],
        ['Cover Letter', formData.cover_letter],
      ].map(([label, value]) => (
        <div key={label}>
          <strong>{label}:</strong>{' '}
          {value ? (
            <p className="inline">{value}</p>
          ) : (
            <span className="text-gray-400">[{`No ${label}`}]</span>
          )}
        </div>
      ))}
    </div>
  );
};

export default PreviewCard;
