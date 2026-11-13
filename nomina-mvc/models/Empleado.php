<?php
// models/Empleado.php

abstract class Empleado {
    // 'protected' permite que las clases hijas (Contratista y Planta) accedan a $nombre
    protected string $nombre;

    // El constructor se ejecuta automáticamente al hacer 'new'
    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    // Métodos Get y Set (Encapsulamiento)
    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    // Método abstracto: obliga a que cada clase hija tenga su propia fórmula de calcularSalario()
    // Esto es la base del POLIMORFISMO.
    abstract public function calcularSalario(): float;
}