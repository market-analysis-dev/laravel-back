<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class OwnerController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $owners = Owner::all();
        return $this->success(data: $owners);
    }

    /**
     * @param Request $request
     * @return ApiResponse
     */
    public function store(Request $request): ApiResponse
    {
        $name = $request->get('name');
        if(empty($name)) {
            return $this->error('Campo name es obligatorio', [], 422);
        }

        try {
            $record = Owner::create([
                'name' => $name,
            ]);

            return $this->success(data: $record);

        } catch (\Exception $e) {
            return $this->error('Failed to create record: ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return ApiResponse
     */
    public function update(Request $request, $id): ApiResponse
    {
        $errors = [];
        $owner = Owner::find($id);
        if(!$owner) {
            $errors[] = 'Owner con id: '. $id . ' no existe';
        }
        $name = $request->get('name');
        if(empty($name)) {
            $errors[] = 'Campo name es obligatorio';
        }
        if(empty($errors)) {
            try {
                $record = $owner->update([
                    'name' => $name,
                ]);

                return $this->success(data: $owner);

            } catch (\Exception $e) {
                return $this->error('No se pudo actualizar el registro: ' . $e->getMessage(), [], 500);
            }
        }
        return $this->error('Errors', $errors, 422);
    }

    /**
     * @param $id
     * @return ApiResponse
     */
    public function destroy($id): ApiResponse
    {
        $errors = [];
        $owner = Owner::find($id);
        if(!$owner) {
            $errors[] = 'Owner con id: '. $id . ' no existe';
        }
        if(empty($errors)) {
            $owner->delete();
            return $this->success('Owner con id: ' . $id . ' fue eliminado exitosamente');
        }
        return $this->error('Errors', $errors, 422);
    }
}
