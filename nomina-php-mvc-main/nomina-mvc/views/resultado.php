<?php
$errores = $errores ?? [];
$empleado = $empleado ?? null;
$tipoTexto = $tipoTexto ?? '';
$sueldoBruto = $sueldoBruto ?? 0;
$deduccionesAplicadas = $deduccionesAplicadas ?? 0;
$salarioTotal = $salarioTotal ?? 0;

require_once __DIR__ . '/../models/Empleado.php';
require_once __DIR__ . '/../models/Contratista.php';
require_once __DIR__ . '/../models/Planta.php';

$nombreEmpleado = ($empleado instanceof Empleado) ? $empleado->getNombre() : 'Empleado';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desprendible de Nómina</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <div class="container">
        <h1>Resultado del Cálculo de Nómina</h1>

        <?php if (!empty($errores)): ?>
            <div class="alert-error">
                <h3>Se encontraron errores en los datos:</h3>
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <table class="tabla-nomina">
                <thead>
                    <tr>
                        <th colspan="2">Desprendible de Pago - <?= htmlspecialchars($nombreEmpleado) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Tipo de Empleado</th>
                        <td><?= htmlspecialchars($tipoTexto) ?></td>
                    </tr>
                    <?php if ($empleado instanceof Contratista): ?>
                        <tr>
                            <th>Valor por Hora</th>
                            <td>$ <?= number_format($empleado->getValorHora(), 2, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Total Horas Trabajadas</th>
                            <td><?= $empleado->getTotalHoras() ?> hrs</td>
                        </tr>
                    <?php elseif ($empleado instanceof Planta): ?>
                        <tr>
                            <th>Sueldo Básico</th>
                            <td>$ <?= number_format($empleado->getSalarioBasico(), 2, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Horas Extras</th>
                            <td>$ <?= number_format($empleado->getHorasExtras(), 2, ',', '.') ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th>Sueldo Bruto</th>
                        <td>$ <?= number_format($sueldoBruto, 2, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Deducciones Aplicadas</th>
                        <td class="texto-rojo">- $ <?= number_format($deduccionesAplicadas, 2, ',', '.') ?></td>
                    </tr>
                    <tr class="fila-total">
                        <th>Salario Total a Pagar</th>
                        <td>$ <?= number_format($salarioTotal, 2, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="acciones">
            <a href="../index.html" class="btn-secondary">← Calcular otro empleado</a>
        </div>
    </div>
</body>
</html>