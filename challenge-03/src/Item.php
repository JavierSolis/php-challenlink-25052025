<?php 
namespace App;

// Clase Item - Objeto básico
class Item
{
    public $name;
    public $quality;
    public $sellIn;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }
}