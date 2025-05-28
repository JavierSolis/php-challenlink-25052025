<?php
namespace App;

class AgedBrieItem extends UpdatableItem
{
    protected function updateQuality()
    {
        $this->increaseQuality(); 
        if ($this->sellIn < 0) {
            $this->increaseQuality(); // Sube otro 1 si ya pasó la fecha
        }
    }
}