<?php 

namespace App\Services;

use App\Models\MeasurementUnit;

class MeasurementUnitService
{
    public function create(array $measurementUnitData): array
    {
        $measurementUnitModel = MeasurementUnit::create($measurementUnitData);

        return $measurementUnitModel->toArray();
    }

    public function all(): array
    {
        return MeasurementUnit::all()->toArray();
    }

    public function get(string $id): array
    {
        return MeasurementUnit::find($id)->toArray();
    }

    public function remove(string $id): void
    {
        MeasurementUnit::find($id)->delete();
    }
}