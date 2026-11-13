<?php
// models/Contratista.php
require_once __DIR__ . '/Empleado.php';

class Contratista extends Empleado {
    private float $valorHora;
    private float $totalHoras;

    public function __construct(string $nombre, float $valorHora, float $totalHoras) {
        // parent::__construct() envía el nombre al constructor de la clase padre (Empleado)
        parent::__construct($nombre);
        $this->valorHora = $valorHora;
        $this->totalHoras = $totalHoras;
    }

    public function getValorHora(): float {
        return $this->valorHora;
    }

    public function getTotalHoras(): float {
        return $this->totalHoras;
    }

    // Implementación específica para Contratista (Polimorfismo)
    public function calcularSalario(): float {
        return $this->valorHora * $this->totalHoras;
    }
}