<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CharOfCat;
use App\Models\Products;
use App\Models\ValueOfChar;
use Illuminate\Http\Request;
use App\Filters\filterOfCategory;

class CategoriesController extends Controller
{
    public function prodOfCatView($categoryId, Request $request)
    {
        if (!empty($request->all())){
            $answer = new filterOfCategory();
            $answer->filter($request->all());
        }

        return view('prodOfCategory', [
            'sortList' => [
                ['val' => 'rand', 'tittle' => 'Randomly'],
                ['val' => 'exp', 'tittle' => 'Expensive at first'],
                ['val' => 'ch', 'tittle' => 'Cheap at firs'],
            ],
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

    public function sortProducts($categoryId, $sort)
    {
        if ($sort == 'rand')
        {
            return redirect(route('prodOfCatView', $categoryId));
        }
        else {
            if ($sort == 'exp') {
                $sortList = [
                    ['val' => 'exp', 'tittle' => 'Expensive at first'],
                    ['val' => 'ch', 'tittle' => 'Cheap at firs'],
                    ['val' => 'rand', 'tittle' => 'Randomly'],
                ];
                $products = Products::query()
                    ->where('category', $categoryId)
                    ->orderBy('price', 'desc')
                    ->paginate(9);
            } else if ($sort == 'ch') {
                $sortList = [
                    ['val' => 'ch', 'tittle' => 'Cheap at firs'],
                    ['val' => 'rand', 'tittle' => 'Randomly'],
                    ['val' => 'exp', 'tittle' => 'Expensive at first'],
                ];
                $products = Products::query()
                    ->where('category', $categoryId)
                    ->orderBy('price', 'asc')
                    ->paginate(9);
            }

            if (isset($products)) {
                return view('prodOfCategory', [
                    'sortList' => $sortList,
                    'category' => Categories::query()
                        ->find($categoryId),
                    'categoriesList' => Categories::all(),
                    'productsList' => $products,
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
    }
}
