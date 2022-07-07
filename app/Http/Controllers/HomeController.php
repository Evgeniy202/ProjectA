<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'productsList' => Products::query()
                ->where('isAvailable', 1)
                ->where('isFavorite', 1)
                ->get(),
            'categoriesList' => Categories::all(),
        ]);
    }
}
