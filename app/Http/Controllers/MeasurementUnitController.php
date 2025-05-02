<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\MeasurementUnitService;

class MeasurementUnitController extends Controller
{
    private MeasurementUnitService $measurementUnitService;

    public function __construct(MeasurementUnitService $measurementUnitService)
    {
        $this->measurementUnitService = $measurementUnitService;
    }

    public function index()
    {
        return response()->json(data: $this->measurementUnitService->all(), status: 200);
    }

    public function store(Request $request)
    {
        $payload = $request->json()->all();

        $validator = Validator::make($payload, [
            'name' => ['required', 'unique:measurement_units,name']
        ], [
            'name.required' => 'Поле обязательно для заполнения',
            'name.unique' => 'Единица измерения с таким названием уже существует'
        ]);

        if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }

        return response()->json(data: $this->measurementUnitService->create($validator->validated()), status: 201);
    }

    public function destroy(string $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'uuid', 'exists:measurement_units,id']
        ]);

        if ($validator->fails()) { return response(status: 404); }

        $this->measurementUnitService->remove($id); 

        return response(status: 204);
    }
}
