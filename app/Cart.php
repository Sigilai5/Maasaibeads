<?php


namespace App;


class Cart
{

    public $items; // ['id' => ['quantity' => , 'price'=>, 'data' =>]]
    public $totalQuantity;
    public $totalPrice;

    //Cart constructor
    public function __construct($prevCart)
    {
        //if cart already has an item(s)
        if($prevCart != null){
            $this->items = $prevCart->items;
            $this->totalQuantity = $prevCart->totalQuantity;
            $this->totalPrice = $prevCart->totalPrice;
            $this->totalPrice = $prevCart->shipping;
            //cart is empty
        }else{
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice =0;

        }

    }

    public function addItem($id,$product){
        $price = (int) str_replace("KSH","",$product->price);
        $shipping = 300;

        //the item already exists
        if(array_key_exists($id,$this->items)){

            $productToAdd = $this->items[$id];
            $productToAdd['quantity']++;
            $productToAdd['totalSinglePrice'] = $productToAdd['quantity'] * $price + $shipping;

            //first time to add this to cart
        }else{
            $productToAdd = ['quantity'=>1, 'totalSinglePrice'=>$price,'data'=>$product,'shipping'=>$shipping];
        }

        $this->items[$id] = $productToAdd;
        $this->totalQuantity++;
        $this->totalPrice = $this->totalPrice + $price + $shipping;

    }

      public function updatePriceAndQuantity(){

        $totalPrice = 0;
        $totalQuantity = 0;

        foreach ($this->items as $item){

            $totalQuantity = $totalQuantity + $item['quantity'];
            $totalPrice = $totalPrice + $item['totalSinglePrice'];

        }

        $this->totalQuantity = $totalQuantity;
        $this->totalPrice = $totalPrice;


      }

      public function shippingCost(){

        $this->shipping = 300;

      }


}
