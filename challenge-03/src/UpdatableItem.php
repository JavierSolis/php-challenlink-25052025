<?php
namespace App;

abstract class UpdatableItem extends Item
{
    // Método que cada subclase debe implementar para la actualización de la calidad
    abstract protected function updateQuality();

    // Lógica común (excepto Sulfuras)
    protected function updateSellIn()
    {
        $this->sellIn = $this->sellIn - 1;
    }

    //Método principal que se llamará por cada item
    public function tick()
    {
        //IMPORTANTE, llamar primero a sellIn, ya que la lógica de quality depende del valor actual de SellIn
        $this->updateSellIn();
        $this->updateQuality();
    }


    //region Util: Métodos auxiliares
    protected function increaseQuality(int $amount = 1)
    {
        $this->quality = min(50, $this->quality + $amount);
    }

    protected function decreaseQuality(int $amount = 1)
    {
        $this->quality = max(0, $this->quality - $amount);
    }
    //endregion Util
}