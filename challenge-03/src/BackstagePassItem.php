<?php
namespace App;

// Backstage Passes
class BackstagePassItem extends UpdatableItem
{
    protected function updateQuality()
    {
        if ($this->sellIn < 0) { // Después del concierto
            $this->quality = 0;
            return;
        } 
        //normalmente
        $this->increaseQuality();

        if ($this->sellIn < 10) {
           $this->increaseQuality();
        }

        if ($this->sellIn < 5) {
           $this->increaseQuality();
        }
        
    }
}