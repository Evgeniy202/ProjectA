<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CharOfCat;
use App\Models\CharOfProd;
use App\Models\Products;
use App\Models\ValueOfChar;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetail($productId)
    {
        $product = Products::query()->find($productId);
        $categories = Categories::all();
        $category = $categories->find($product->category);
        $charsOfProd = CharOfProd::query()
            ->where('product', $productId)
            ->orderBy('numberInList', 'asc')
            ->get();

        return view('productDetail', [
            'product' => $product,
            'category' => $category,
            'categoriesList' => $categories,
            'charsOfProd' => $charsOfProd,
            'charsList' => CharOfCat::query()
                ->where('category', $category->id)
                ->orderBy('numberInFilter', 'asc')
                ->get(),
            'valuesList' => ValueOfChar::query()
                ->orderBy('numberInFilter', 'asc')
                ->get()
        ]);
    }
}
