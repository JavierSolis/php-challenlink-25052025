<?php

namespace App;

class GildedRose
{
    private UpdatableItem $item;
    public $quality;
    public $sellIn;

    public function __construct($name, $quality, $sellIn)
    {
        /**
         * Si fuera php>8.0 se podría usar
         *  match ($name) {
         *   'Aged Brie' => new AgedBrieItem($name, $quality, $sellIn),
         * ...
         */
        switch ($name) {
            case 'Aged Brie':
                $this->item = new AgedBrieItem($name, $quality, $sellIn); 
                break;
            case 'Sulfuras, Hand of Ragnaros':
                // Nota: Sulfuras tiene su calidad fijada en 80 en su constructor
                $this->item = new SulfurasItem($name, $quality, $sellIn);
                break;
            case 'Backstage passes to a TAFKAL80ETC concert':
                $this->item = new BackstagePassItem($name, $quality, $sellIn);
                break;
            case 'Conjured Mana Cake': // ¡El nuevo tipo!
                $this->item = new ConjuredItem($name, $quality, $sellIn);
                break;
            default:
                $this->item = new DefaultItem($name, $quality, $sellIn);
                break;
        }
    }

    public static function of($name, $quality, $sellIn): GildedRose
    {
        return new static($name, $quality, $sellIn);
    }

    public function tick()
    {
        $this->item->tick();
        //update de atributos facade
        $this->updateAttributesFacade();
    }
    
    public function updateAttributesFacade(){
        $this->quality = $this->item->quality;
        $this->sellIn = $this->item->sellIn;
    }
}
