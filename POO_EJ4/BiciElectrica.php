<?php

class BiciElectrica {
    private $id; // Identificador de la bicicleta (entero)
    private $coordx; // Coordenada X (entero)
    private $coordy; // Coordenada Y (entero)
    private $bateria; // Carga de la batería en tanto por ciento (entero)
    private $operativa; // Estado de la bicleta ( true operativa - false no disponible)

    public function __set($name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __toString() {
        return "<br><br>Id de la bicicleta = " . $this->id . "<br>Estado de la batería = " . $this->bateria . "%";
    }

    public function distancia($x, $y): int {
        return round(sqrt(($x - $this->coordx) * ($x - $this->coordx) + ($y - $this->coordy) * ($y - $this->coordy)));
    }
}
