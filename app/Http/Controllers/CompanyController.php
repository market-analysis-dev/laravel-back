<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController
{
    // * Método para obtener todos los registros.
    public function index()
    {
        $companies = Company::where('status', 1)->get();
        return response()->json($companies);
    }

    // * Método para obtener un registro por su ID.
    public function show($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json($company);
    }

    // * Método para editar la información de la empresa por su ID.
    public function update(Request $request, $id)
    {
        // * Validar los datos
        $request->validate([
            'name_comany' => 'required|string|max:255',
            'website' => 'nillable|url|max:255',
            'logo_url' => 'nullable|string|max:255',
            'address' => 'nillable|string|max:255',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
        ]);

        // * Buscar la empresa por ID.
        $company = Company::findOrFail($id);

        // * UPDATE de la empresa.
        $company->update([
            'name_company' => $request->input('name_company'),
            'website' => $request->input('website'),
            'logo_url' => $request->input('logo_url'),
            'address' => $request->input('address'),
            'primary_color' => $request->input('primary_color'),
            'secondary_color' => $request->input('secondary_color'),
        ]);

        return response()->json($company);
    }

    // * Método para eliminar una epresa.
    public function delete($id)
    {
        // * Buscando la empresa por su ID.
        $company = Company::findOrFail($id);

        // * Actualizar el estado a 0.
        $empresa->status = 0;
        $empresa->save();

        return response()->json(['message' => 'Empresa eliminada correctamente.']);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name_company' => 'required|string|max:255',
            'website' => 'nullable|url',
            'logo_url' => 'nullable|string',
            'address' => 'nullable|string',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'status' => 'required|integer|in:0,1',
        ]);
    }
}
