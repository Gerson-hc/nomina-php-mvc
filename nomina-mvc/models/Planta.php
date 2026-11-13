<?php
// models/Planta.php
require_once __DIR__ . '/Empleado.php';

class Planta extends Empleado {
    private float $salarioBasico;
    private float $horasExtras;
    private float $deducciones;

    public function __construct(string $nombre, float $salarioBasico, float $horasExtras, float $deducciones) {
        parent::__construct($nombre);
        $this->salarioBasico = $salarioBasico;
        $this->horasExtras = $horasExtras;
        $this->deducciones = $deducciones;
    }

    public function getSalarioBasico(): float {
        return $this->salarioBasico;
    }

    public function getHorasExtras(): float {
        return $this->horasExtras;
    }

    public function getDeducciones(): float {
        return $this->deducciones;
    }

    // Implementación específica para Planta (Polimorfismo)
    public function calcularSalario(): float {
        return ($this->salarioBasico + $this->horasExtras) - $this->deducciones;
    }
}