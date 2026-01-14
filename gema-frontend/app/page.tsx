"use client";
import { useEffect, useState } from 'react';

export default function GestionActivos() {
  const [usuarios, setUsuarios] = useState([]);

  // 1. Cargar los datos desde tu nuevo api_usuarios.php [cite: 74]
  useEffect(() => {
    fetch('http://localhost/gema-backend/api_usuarios.php')
      .then(res => res.json())
      .then(data => setUsuarios(data))
      .catch(err => console.error("Error cargando datos:", err));
  }, []);

  // Función para crear cada tabla según el estado [cite: 6, 7]
  const renderTabla = (titulo: string, codigo: number) => {
    const filtrados = usuarios.filter((u: any) => parseInt(u.estado) === codigo);
    return (
      <div className="bg-white p-6 rounded-xl shadow-md mb-8 border border-gray-100">
        <h2 className="text-xl font-bold mb-4 text-gray-800">{titulo} ({filtrados.length})</h2>
        <table className="w-full text-left border-collapse">
          <thead>
            <tr className="text-gray-400 border-b text-sm">
              <th className="pb-3 font-medium">Email</th>
              <th className="pb-3 font-medium">Nombre</th>
              <th className="pb-3 font-medium">Apellido</th>
            </tr>
          </thead>
          <tbody className="text-gray-600">
            {filtrados.map((u: any, i) => (
              <tr key={i} className="border-b last:border-0 hover:bg-gray-50 transition">
                <td className="py-4 text-blue-600">{u.email}</td>
                <td className="py-4">{u.nombre || '---'}</td>
                <td className="py-4">{u.apellido || '---'}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    );
  };

  return (
    <div className="min-h-screen bg-gray-50 p-10 font-sans">
      <div className="max-w-5xl mx-auto">
        <div className="flex justify-between items-center mb-10">
          <h1 className="text-3xl font-extrabold text-gray-900 tracking-tight">Gestión de Activos</h1>
          <button className="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
            Cargar Archivo
          </button>
        </div>
        
        {/* Tablas requeridas [cite: 65, 66, 68] */}
        {renderTabla("Activos", 1)}
        {renderTabla("Inactivos", 2)}
        {renderTabla("En Espera", 3)}
      </div>
    </div>
  );
}