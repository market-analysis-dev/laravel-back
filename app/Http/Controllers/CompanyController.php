<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController
{
    // * Método para obtener todos los registros.
    public function index()
    {
        // $companies = Company::where('status', 'Activo')->get();
        // return response()->json($companies);
        $companies = Company::where('status', 'Activo')->get();

        // * Iterar sobre cada compañía y generar la URL completa de la imagen
        foreach ($companies as $company) {
            if ($company->logoUrl) {
                $company->logoUrl = "http://localhost:8000" . Storage::url($company->logoUrl);
            }
        }

        return response()->json($companies);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameCompany' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'logoUrl' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:Activo,Inactivo',
            'primaryColor' => 'nullable|string|max:7',
            'secondaryColor' => 'nullable|string|max:7',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postalCode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $company = new Company();
        $company->nameCompany = $request->nameCompany;
        $company->website = $request->website;
        $company->primaryColor = $request->primaryColor;
        $company->secondaryColor = $request->secondaryColor;
        $company->address = $request->address;
        $company->postalCode = $request->postalCode;
        $company->city = $request->city;
        $company->state = $request->state;
        $company->country = $request->country;

        if ($request->hasFile('logoUrl')) {
            $imagePath = $request->file('logoUrl')->store('logos', 'public');
            $company->logoUrl = $imagePath;
        }

        $company->save();

        return response()->json(['success' => 'Company added successfully.']);
    }

    // * Método para obtener un registro por su ID.
    public function show($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        // Genera la URL completa de la imagen
        if ($company->logoUrl) {
            $company->logoUrl = "http://localhost:8000" . Storage::url($company->logoUrl);
        }

        return response()->json($company);
    }

    // * Método para editar la información de la empresa por su ID.
    public function update(Request $request, $id)
    {
        $request->validate([
            'nameCompany' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'logoUrl' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|string|max:255',
            'primaryColor' => 'required|string|max:255',
            'secondaryColor' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postalCode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $company = Company::findOrFail($id);
        $company->nameCompany = $request->all()['nameCompany'];
        $company->website = $request->all()['website'];
        $company->primaryColor = $request->all()['primaryColor'];
        $company->secondaryColor = $request->all()['secondaryColor'];
        $company->status = $request->all()['status'];
        $company->address = $request->all()['address'];
        $company->postalCode = $request->all()['postalCode'];
        $company->city = $request->all()['city'];
        $company->state = $request->all()['state'];
        $company->country = $request->all()['country'];

        if ($request->hasFile('logoUrl')) {

            if ($company->logoUrl) {
                Storage::disk('public')->delete($company->logoUrl);
            }

            $imagePath = $request->file('logoUrl')->store('logos', 'public');
            $company->logoUrl = $imagePath;
        }

        $company->save();

        return response()->json(['success' => 'Company updated successfully.']);
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
