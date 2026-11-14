<?php
// models/Contratista.php
require_once __DIR__ . '/Empleado.php';

class Contratista extends Empleado {
    protected float $valorHora;
    protected float $totalHoras;

    public function __construct(string $nombre, float $valorHora, float $totalHoras) {
        // parent::__construct() envía el nombre al constructor de la clase padre (Empleado)
        parent::__construct($nombre);
        $this->valorHora = $valorHora;
        $this->totalHoras = $totalHoras;
    }

    // Implementación específica para Contratista (Polimorfismo)
    public function calcularSalario(): float {
        return $this->valorHora * $this->totalHoras;
    }

    public function getValorHora(): float {
        return $this->valorHora;
    }

    public function getTotalHoras(): float {
        return $this->totalHoras;
    }

    public function setValorHora(float $valorHora): void {
        $this->valorHora = $valorHora;
    }

    public function setTotalHoras(float $totalHoras): void {
        $this->totalHoras = $totalHoras;
    }
}
