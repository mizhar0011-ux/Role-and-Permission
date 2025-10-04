<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class ProductIndex extends Component
{
    public function render()
    {
        $products = Product::get();
        return view('livewire.products.product-index', compact("products"));
    }

        public function delete(Product $product) 
    {
        $product->delete();
        session()->flash('message', 'User deleted successfully.');
    }
}
