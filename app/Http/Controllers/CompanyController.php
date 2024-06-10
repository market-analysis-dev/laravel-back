<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController
{
    // * Método para obtener todos los registros.
    public function index()
    {
        $companies = Company::where('status', 'Activo')->get();
        return response()->json($companies);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameCompany' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'logoUrl' => 'nullable|string|max:255',
            'status' => 'required|in:Activo,Inactivo',
            'primaryColor' => 'nullable|string|max:7',
            'secondaryColor' => 'nullable|string|max:7',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postalCode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        return Company::create($request->all());
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
            'nameCompany' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'logoUrl' => 'nullable|string|max:255',
            'status' => 'required|in:Activo,Inactivo',
            'primaryColor' => 'nullable|string|max:7',
            'secondaryColor' => 'nullable|string|max:7',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postalCode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        // * Buscar la empresa por ID.
        $company = Company::findOrFail($id);

        // * UPDATE de la empresa.
        $company->update($request->all());

        return response()->json($company);
    }

    // * Método para eliminar una epresa.
    public function destroy($id)
    {

        $company = Company::findOrFail($id);
        $company->status = 'Inactivo';
        $company->save();

        return response()->json(['message' => 'Empresa eliminada correctamente.']);
    }
}
