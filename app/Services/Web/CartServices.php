<?php

namespace App\Services\Web;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use App\Exceptions\CartNotFoundException;
use App\Exceptions\CartItemExistException;


class CartServices
{
    private $cart;

    public function __construct()
    {
        $cart = Cookie::get('cart-id');        

        try {
            Self::find($cart);
        } catch (CartNotFoundException $e) {
            return abort($e->getMessage(), $e);
        }

        Self::createCart($cart);
       
    }

    public function createCart($cart)
    {
        if (!is_null($cart))  return;

        Cart::create([
            'cart_id' => $cart,
            'expired_at' =>  now()->addDays(5),
        ]); 
    }

    private function find($cart_id)
    {
        
        $this->cart = Cart::where('cart_id', $cart_id)->firstOrFail(); 

        if (!$this->cart) {
           throw new CartNotFoundException('Cart not found', 422);
        } 
              
    }

    public function itemExist($product_id)
    {   
        $item = $this->cart->items->where('product_id', $product_id)->first();

        if ($item) {
            throw new CartItemExistException('Item already Exist in your Cart', 422);
        }

        return false;

    }

    public function addItem($product_id, $qty = 1, $properties = [])
    {

        $attributes = [];

        $result = Self::itemExist($product_id);
      
        if ($result ===  false) {           

            foreach ($properties as $item) {
                $attributes += array($item['name'] => $item['value']);
            }

            return CartItem::create([
                'cart_id' => $this->cart->id,
                'product_id' => $product_id,
                'qty' => $qty,
                'attributes' => $attributes,
            ]);

        } 
        
    }

    public function updateItemQuantity($id, $qty)
    {
        $item = $this->cart->items->where('id', $id)->first();
        $item->qty = $qty;
        $item->save();
        return $item;
    }

    public function destroyItem($id)
    {
        $item = $this->cart->items->where('id', $id)->first();
        return $item->delete();    
    }


    public function getItems()
    {
        return $this->cart->items->load('product');
    }

    public function getSubtotal()
    {
        return $this->cart->subtotal() ?? 0;
    }

    public function getCartCount()
    {        
        $total = 0;
        foreach($this->cart->items as $item) {
            $total += $item->qty;
        }
        return $total;
    }


}
