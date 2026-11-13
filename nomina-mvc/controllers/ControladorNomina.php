<?php

// controllers/ControladorNomina.php
require_once __DIR__ . '/../models/Contratista.php';
require_once __DIR__ . '/../models/Planta.php';

// Verificar que la petición llegue por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.html');
    exit;
}

// 1. Capturar y limpiar datos generales
$nombre = trim($_POST['nombre'] ?? '');
$tipoEmpleado = $_POST['tipo_empleado'] ?? '';
$errores = [];

if (empty($nombre)) {
    $errores[] = "El nombre del empleado es obligatorio.";
}

$empleado = null;
$tipoTexto = '';
$sueldoBruto = 0;
$deduccionesAplicadas = 0;
$salarioTotal = 0;

// 2. Validar según el tipo de empleado e instanciar objeto (POO)
if ($tipoEmpleado === 'contratista') {
    $valorHora = filter_input(INPUT_POST, 'valor_hora', FILTER_VALIDATE_FLOAT);
    $totalHoras = filter_input(INPUT_POST, 'total_horas', FILTER_VALIDATE_FLOAT);

    if ($valorHora === false || $valorHora <= 0) {
        $errores[] = "El valor por hora debe ser un número mayor a cero.";
    }
    if ($totalHoras === false || $totalHoras <= 0) {
        $errores[] = "El total de horas debe ser un número mayor a cero.";
    }

    if (empty($errores)) {
        $empleado = new Contratista($nombre, $valorHora, $totalHoras);
        $tipoTexto = "Contratista";
        $salarioTotal = $empleado->calcularSalario();
        $sueldoBruto = $salarioTotal; // No tiene deducciones en este modelo
        $deduccionesAplicadas = 0;
    }

} elseif ($tipoEmpleado === 'planta') {
    $sueldoBasico = filter_input(INPUT_POST, 'sueldo_basico', FILTER_VALIDATE_FLOAT);
    $horasExtras = filter_input(INPUT_POST, 'horas_extras', FILTER_VALIDATE_FLOAT);
    $deducciones = filter_input(INPUT_POST, 'deducciones', FILTER_VALIDATE_FLOAT);

    if ($sueldoBasico === false || $sueldoBasico <= 0) {
        $errores[] = "El sueldo básico debe ser un número mayor a cero.";
    }
    if ($horasExtras === false || $horasExtras < 0) {
        $errores[] = "Las horas extras no pueden ser negativas.";
    }
    if ($deducciones === false || $deducciones < 0) {
        $errores[] = "Las deducciones no pueden ser negativas.";
    }

    if (empty($errores)) {
        $empleado = new Planta($nombre, $sueldoBasico, $horasExtras, $deducciones);
        $tipoTexto = "Empleado de Planta";
        $sueldoBruto = $empleado->getSalarioBasico() + $empleado->getHorasExtras();
        $deduccionesAplicadas = $empleado->getDeducciones();
        $salarioTotal = $empleado->calcularSalario();
    }

} else {
    $errores[] = "Debe seleccionar un tipo de empleado válido.";
}

// 3. Enviar el resultado (o errores) hacia la Vista HTML
require_once __DIR__ . '/../views/resultado.php';