<?php

namespace App\Http\Controllers\Api;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /*
   Get all the products
    */

    public function index()
    {
      return ProductResource::collection(Product:with(['colors','size','reviews'])->latest()->get())->additional([
        'colors' => Color::has('products')->get(),
        'sizes' => Size::has('products')->get(),

      ]);
    }
    /*
   Get product by slug
    */

    public function show(Product $product)
    {
      return ProductResource::make(
    $product->load(['colors','sizes','reviews']));
    }

    /**
    * Filter products by color
    */

    public function filterProductsByColor(Color $color)
    {
      return ProductResource::collection($color->products()->with(['colors','size','reviews'])->latest()->get())->additional([
        'colors' => Color::has('products')->get(),
        'sizes' => Size::has('products')->get(),

      ]);
    }

}
