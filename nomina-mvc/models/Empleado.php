<?php
// models/Empleado.php

abstract class Empleado {
    // '#' en el UML = protected: las clases hijas (Contratista y Planta) pueden acceder
    protected string $nombre;
    protected int $documento = 0;

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

    public function setDocumento(int $documento): void {
        $this->documento = $documento;
    }

    public function getDocumento(): int {
        return $this->documento;
    }

    public function setNombreCompleto(string $nombreCompleto): void {
        $this->nombre = $nombreCompleto;
    }

    public function getNombreCompleto(): string {
        return $this->nombre;
    }

    // Método abstracto: obliga a que cada clase hija tenga su propia fórmula de calcularSalario()
    // Esto es la base del POLIMORFISMO.
    abstract public function calcularSalario(): float;
}
