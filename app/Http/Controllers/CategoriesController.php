<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CharOfCat;
use App\Models\Products;
use App\Models\ValueOfChar;
use App\Filters\filterOfCategory;
use App\Http\Requests\FilterRequest;

class CategoriesController extends Controller
{
    public function prodOfCatView($categoryId, FilterRequest $request)
    {
        $products = Products::query()
            ->where('category', $categoryId)
            ->inRandomOrder()
            ->paginate(9);

        $sortList = [
            ['val' => 'rand', 'tittle' => 'Randomly'],
            ['val' => 'exp', 'tittle' => 'Expensive at first'],
            ['val' => 'ch', 'tittle' => 'Cheap at firs'],
        ];

        if (!empty($request->all())){
            $answer = new filterOfCategory();
            $products = $answer->filter($categoryId, $request);
        }

        if ($request->filled('sort'))
        {
            $sort = $request->sort;

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
            }
        }
    dd($request);
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
