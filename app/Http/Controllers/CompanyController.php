<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController
{
    // Método para obtener todos los registros
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    // Método para obtener un registro por su ID
    public function show($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json($company);
    }
}
