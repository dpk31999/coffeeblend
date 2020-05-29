<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items = null;
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldcart)
    {
        if($oldcart)
        {
            $this->items = $oldcart->items;
            $this->totalQuantity = $oldcart->totalQuantity;
            $this->totalPrice = $oldcart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['quantity' => 0, 'price' => $item->price, 'item' => $item];
        if($this->item)
        {
            if(array_key_exists($id,$this->item))
            {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['quantity']++;
        $storedItem['price'] = $item->price * $storedItem['quantity'];
        $this->items[$id] = $storedItem;
        $this->totalQuantity++;
        $this->totalPrice += $item->price;
    }
}
