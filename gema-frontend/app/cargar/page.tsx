"use client";
import { useState } from 'react';
import { useRouter } from 'next/navigation';

export default function CargarArchivo() {
  const [file, setFile] = useState<File | null>(null);
  const [error, setError] = useState("");
  const router = useRouter();

  const handleUpload = async () => {
    if (!file) {
      setError("Por favor, selecciona un archivo primero.");
      return;
    }

    const formData = new FormData();
    formData.append('archivo', file); 

    try {
      const res = await fetch('http://localhost/gema-backend/process.php', {
        method: 'POST',
        body: formData,
      });

      const contentType = res.headers.get("content-type");
      if (contentType && contentType.indexOf("application/json") !== -1) {
        const data = await res.json();

        if (data.status === "success") {

        } else {
          
          setError(data.message || "Error al procesar el archivo.");
        }
      } else {
        
        const textError = await res.text();
        console.error("Error técnico del servidor:", textError);
        setError("El servidor devolvió una respuesta no válida. Revisa la consola.");
      }
    } catch (err) {
      
      setError("No se pudo conectar con el servidor PHP. Revisa que XAMPP esté activo.");
    }
  };

  return (
    <div className="min-h-screen bg-gray-50 flex flex-col items-center justify-center p-4">
      <div className="w-full max-w-2xl bg-white rounded-3xl border-2 border-dashed border-blue-200 p-12 text-center shadow-md">
        <div className="mb-4 flex justify-center text-blue-500 text-6xl">
        </div>
        <h2 className="text-2xl font-semibold text-gray-700 mb-6">
          Arrastra y suelta tu archivo .txt aquí
        </h2>
        
        <input 
          type="file" 
          accept=".txt" 
          onChange={(e) => {
            setFile(e.target.files?.[0] || null);
            setError(""); 
          }} 
          className="mb-6 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer" 
        />
        
        <button 
          onClick={handleUpload} 
          className="bg-blue-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg active:transform active:scale-95"
        >
          Cargar Archivo
        </button>
      </div>

      {error && (
        <div className="mt-8 w-full max-w-2xl bg-red-50 border border-red-200 p-5 rounded-2xl flex items-start gap-4 animate-in fade-in slide-in-from-top-4">
          <div className="bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center font-bold">!</div>
          <div>
            <p className="text-red-800 font-bold italic">Error de Validación</p>
            <p className="text-red-600 text-sm">{error}</p>
          </div>
        </div>
      )}
    </div>
  );
}