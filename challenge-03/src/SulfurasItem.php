<?php

namespace App;

// Sulfuras - No hereda de UpdatableItem porque no tiene SellIn variable ni Quality.
//Heredamos de UpdataleItem para no alterar mucho al clase GlidRose
class SulfurasItem extends UpdatableItem
{
    protected function updateQuality()
    {
        // no hace nada
    }
    
    public function tick()
    {
        // no hace nada
    }

    // Para asegurar que siempre es 80
    public function __construct($name, $quality, $sellIn)
    {
        parent::__construct($name, 80, $sellIn); // Quality siempre 80
    }
}