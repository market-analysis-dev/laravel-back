<?php

namespace App\Http\Controllers;

use App\Models\Builder;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class BuilderController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $builders = Builder::all();
        return $this->success(data: $builders);
    }

    /**
     * @param Request $request
     * @return ApiResponse
     */
    public function store(Request $request): ApiResponse
    {
        $errors = [];

        $name = $request->get('name');
        if(empty($name)) {
            $errors[] = 'Campo name es obligatorio';
        }

        if(empty($errors)) {
            try {
                $builder = Builder::create([
                    'name' => $name
                ]);
                return $this->success(data: $builder);
            } catch (\Exception $e) {
                return $this->error('No se pudo crear el registro: ' . $e->getMessage(), [], 500);
            }
        }
        return $this->error('Errors', $errors, 422);
    }

    /**
     * @param Request $request
     * @param $id
     * @return ApiResponse
     */
    public function update(Request $request, $id): ApiResponse
    {
        $errors = [];
        $builder = Builder::find($id);

        if(!$builder) {
            $errors[] = 'Builder con id: ' . $id . ' no existe';
        }

        $name = $request->get('name');
        if(empty($name)) {
            $errors[] = 'Campo name es obligatorio';
        }

        if(empty($errors)) {
            try {
                $builder->update([
                    'name' => $name,
                ]);
                return $this->success(data: $builder);
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
        $builder = Builder::find($id);

        if(!$builder) {
            $errors[] = 'Builder con id: ' . $id . ' no existe';
        }

        if(empty($errors)) {
            try {
                $builder->delete();
                return $this->success('Builder con id: ' . $id . ' fue eliminado exitosamente');
            } catch (\Exception $e) {
                return $this->error('No se pudo eliminar el registro: ' . $e->getMessage(), [], 500);
            }
        }
        return $this->error('Errors', $errors, 422);
    }
}
