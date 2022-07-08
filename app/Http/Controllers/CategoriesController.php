<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CharOfCat;
use App\Models\Products;
use App\Models\ValueOfChar;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function prodOfCatView($categoryId)
    {
        return view('prodOfCategory', [
            'category' => Categories::query()
                ->find($categoryId),
            'categoriesList' => Categories::all(),
            'productsList' => Products::query()
                ->where('category', $categoryId)
                ->inRandomOrder()
                ->paginate(9),
            'charsList' => CharOfCat::query()
                ->where('category', $categoryId)
                ->orderBy('numberInFilter', 'asc')
                ->get(),
            'valuesList' => ValueOfChar::query()
                ->orderBy('numberInFilter', 'asc')
                ->get()
        ]);
    }
}
