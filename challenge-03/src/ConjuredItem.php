<?php
namespace App;

class ConjuredItem extends UpdatableItem
{
    protected function updateQuality()
    {
        // Se degrada el doble de rápido que un ítem normal
        $this->decreaseQuality(2); 
        if ($this->sellIn < 0) {
            $this->decreaseQuality(2); // otros 2 si ya pasó la fecha (-4 total)
        }
    }
}