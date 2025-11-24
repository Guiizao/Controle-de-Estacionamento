<?php

namespace App\Application\Controllers;

use App\Application\Services\ParkingService;
use App\Domain\Enums\VehicleType;

class EntryController
{
    public function __construct(private ParkingService $service) {}

    public function handle(): void
    {
        $plate = $_POST['plate'] ?? '';
        $type = $_POST['type'] ?? '';

        $vehicleType = match (strtolower($type)) {
            'carro'    => VehicleType::CAR,
            'moto'     => VehicleType::MOTO,
            'caminhao',
            'caminhão' => VehicleType::TRUCK,
            default    => throw new \Exception("Tipo de veículo inválido."),
        };

        $this->service->enter($plate, $vehicleType);
    }
}
