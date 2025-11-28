<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand'])->paginate(14);
          return Inertia::render('products/CatalogProduct', [
            'products' => $products  
          ]);
    }
    public function show($id)
    {
        $currentProduct = Product::with('brand')->find($id);

        if(!$currentProduct){

           abort(403, 'Товар не найден');
        }


        return Inertia::render('products/ProductPage',[
            'product' => $currentProduct
        ]);
    }


}
