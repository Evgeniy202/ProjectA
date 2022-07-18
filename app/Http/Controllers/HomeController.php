<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //TODO for the future
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!empty(Auth::user()->id))
        {
            $chosenOne = \App\Models\Selected::query()->where('user', Auth::user()->id)->get();
        }
        $chosenOneArray = [];

        if ((!empty($chosenOne)) && ($chosenOne != null))
        {
            foreach ($chosenOne as $chosenProduct) {
                array_push($chosenOneArray, $chosenProduct->product);
            }
        }

        return view('home', [
            'productsList' => Products::query()
                ->where('isAvailable', 1)
                ->where('isFavorite', 1)
                ->paginate(25),
            'categoriesList' => Categories::all(),
            'chosenOneArray' => $chosenOneArray
        ]);
    }
}
