<?php
namespace App;

// Ítems Normales
class DefaultItem extends UpdatableItem
{
    protected function updateQuality()
    {
        $this->decreaseQuality(); // Baja 1
        if ($this->sellIn < 0) { // si es cero, ya es el día de venta, y se toma como paso
            $this->decreaseQuality(); // Baja otro 1 si ya pasó la fecha
        }
    }
}