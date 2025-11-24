<?php

require __DIR__ . "/vendor/autoload.php";

use App\Application\Controllers\EntryController;
use App\Application\Controllers\ExitController;
use App\Application\Controllers\ReportController;
use App\Application\Services\ParkingService;
use App\Application\Services\RateCalculator;
use App\Domain\Repositories\SQLiteParkingRepository;
use Exception;

$databaseConnection = require __DIR__ . "/Infra/Database/connection.php";

$parkingRepository = new SQLiteParkingRepository($databaseConnection);
$rateCalculator = new RateCalculator();
$parkingService = new ParkingService($parkingRepository, $rateCalculator);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estacionamento Inteligente</title>
</head>
<body>
<h1>Controle de Estacionamento</h1>

<h2>Entrada</h2>
<form method="POST" action="?action=entry">
    Placa: <input name="plate" required>
    Tipo:
    <select name="type">
        <option value="carro">Carro</option>
        <option value="moto">Moto</option>
        <option value="caminhao">Caminhão</option>
    </select>
    <button type="submit">Registrar Entrada</button>
</form>

<h2>Saída</h2>
<form method="POST" action="?action=exit">
    Placa: <input name="plate" required>
    Horas (opcional): <input type="number" name="hours" min="1">
    <button type="submit">Registrar Saída</button>
</form>

<h2>Relatório</h2>
<a href="?action=report">Ver relatório (JSON)</a>

<hr>

<?php
$action = $_GET['action'] ?? null;

if ($action === null) {
    exit;
}

if ($action === 'entry') {
    try {
        $result = (new EntryController($parkingService))->handle();

        $plate = $result['plate'] ?? null;
        $vehicleType = $result['type'] ?? null;

        echo "<p>O veículo do tipo <strong>{$vehicleType}</strong> com a placa <strong>{$plate}</strong> teve a entrada registrada.</p>";
    } catch (Exception $exception) {
        echo "<p style='color: red'>" . $exception->getMessage() . "</p>";
    }
} elseif ($action === 'exit') {
    try {
        $result = (new ExitController($parkingService))->handle();

        $plate = $result['plate'];
        $vehicleType = $result['type'];
        $amountToPay = $result['amount'];

        echo "<p>O veículo do tipo <strong>{$vehicleType}</strong> com a placa <strong>{$plate}</strong> teve a saída registrada.</p>";
        echo "<p>Total a pagar: R$ " . number_format($amountToPay, 2, ',', '.') . "</p>";
    } catch (Exception $exception) {
        echo "<p style='color: red'>" . $exception->getMessage() . "</p>";
    }
} elseif ($action === 'report') {
    ob_start();
    (new ReportController($parkingService))->handle();
    $reportJson = ob_get_clean();

    $reportData = json_decode($reportJson, true);

    echo "<h2>Relatório de Faturamento</h2>";

    echo "<table border='1' cellpadding='8' cellspacing='0'>
            <tr>
                <th>Tipo</th>
                <th>Total</th>
                <th>Faturamento (R$)</th>
            </tr>";

    foreach ($reportData as $item) {
        $vehicleType = $item['type'];
        $totalVehicles = $item['total'];
        $revenue = $item['revenue'];

        echo "<tr>
                <td>{$vehicleType}</td>
                <td>{$totalVehicles}</td>
                <td>" . number_format($revenue, 2, ',', '.') . "</td>
              </tr>";
    }

    echo "</table>";
}
?>
</body>
</html>
