<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Session\GetSelected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Session\GetCategories;

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
        $categoriesList = new GetCategories();
        $categoriesList = $categoriesList->getCategoriesList();

        $chosenOneArray = new GetSelected();
        $chosenOneArray = $chosenOneArray->getSelected();

        return view('home', [
            'productsList' => Products::query()
                ->where('isAvailable', 1)
                ->where('isFavorite', 1)
                ->paginate(25),
            'categoriesList' => $categoriesList,
            'chosenOneArray' => $chosenOneArray
        ]);
    }
}
