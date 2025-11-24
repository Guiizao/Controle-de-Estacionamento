<?php

namespace App\Application\Services;

use App\Domain\Enums\VehicleType;
use DateTimeInterface;

class RateCalculator implements RateCalculatorInterface
{
    public function calculate(
        VehicleType $type,
        DateTimeInterface $entryAt,
        DateTimeInterface $exitAt,
        ?int $overrideHours = null
    ): float {
        if ($overrideHours !== null && $overrideHours >= 1) {
            $hours = $overrideHours;
        } else {
            $seconds = $exitAt->getTimestamp() - $entryAt->getTimestamp();
            $hours = (int) ceil($seconds / 3600);
            if ($hours < 1) {
                $hours = 1;
            }
        }

        $rate = match ($type) {
            VehicleType::CAR   => 5.0,
            VehicleType::MOTO  => 3.0,
            VehicleType::TRUCK => 10.0,
        };

        return $rate * $hours;
    }
}
