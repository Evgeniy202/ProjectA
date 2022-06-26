<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categories;
use App\Models\CharOfCat;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use SebastianBergmann\Type\Exception;

class AdminController extends Controller
{
    public function signIn()
    {
        return view('admin.login');
    }

    public function loginCheck(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        $data = Admin::where('login', '=', $login)->where('password', '=', $password)->first();

        if ($data != null)
        {
            session(['admin'=>'true', 'accessLevel'=>$data->accessLevel]);
            return redirect('/admin/adm/mainAdm');
        }
        else
        {
            return view('admin.login');
        }
    }

    public function mainAdm(Request $request) 
    {
        if (session('admin') != null)
        {
            return view('admin.mainAdm', ['admin'=>session('admin'), 'accessLevel'=>session('accessLevel')]);
        }
        elseif (session(('admin') == null))
        {
            return view('admin.login');
        }
    }

    public function categories()
    {
        if (session('admin') != null)
        {
            return view('admin.category', [
                'admin'=>session('admin'), 
                'accessLevel'=>session('accessLevel'),
                'data'=>Categories::all()
            ]);
        }
    }

    public function products()
    {
        if (session('admin') != null)
        {
            return view('admin.products', [
                'admin'=>session('admin'), 
                'accessLevel'=>session('accessLevel'),
                'categoriesList'=>Categories::all(),
                'productsList'=>Products::all()
            ]);
        }
    }

    public function addCategory(Request $request)
    {
        $review = new Categories();
        $review->tittle = $request->input('tittle');
        $review->save();

        return redirect(route('admCategories'));
    }

    public function removeCategory($id)
    {
        Categories::find($id)->delete();

        return redirect(route('admCategories'));
    }

    public function changeCategory(Request $request, $id)
    {
        $review = Categories::find($id);
        $review->tittle = $request->input('tittle');
        $review->save();

        return redirect(route('admCategories'));
    }

    public function addProduct(Request $request)
    {
        $review = new Products();

        $price = $request-> input('price');
        $isAvailable = $request->input('isAvailable');
        if ($isAvailable != 1) { $isAvailable = 0; }
        $isFavorite = $request->input('isFavorite');
        if ($isFavorite != 1) { $isFavorite = 0; }

        $path = $request->file('mainImg')->store('products', 'public') ?? null;
        $path_1 = $request->file('img_1') ?? null;
        $path_2 = $request->file('img_2') ?? null;
        $path_3 = $request->file('img_3') ?? null;
        $path_4 = $request->file('img_4') ?? null;
        $path_5 = $request->file('img_5') ?? null;
        $path_6 = $request->file('img_6') ?? null;
        $path_7 = $request->file('img_7') ?? null;
        $path_8 = $request->file('img_8') ?? null;
        $path_9 = $request->file('img_9') ?? null;
        $path_10 = $request->file('img_10') ?? null;

        try {
            $review->category = $request->input('category');
            $review->tittle = $request->input('tittle');
            $review->slug = $request->input('slug');
            $review->description = $request->input('description');
            $review->price = round((float)$price, 2);
            $review->isAvailable = $isAvailable;
            $review->isFavorite = $isFavorite;
            $review->mainImage = $path;
            $review->img_1 = $path_1;
            $review->img_2 = $path_2;
            $review->img_3 = $path_3;
            $review->img_4 = $path_4;
            $review->img_5 = $path_5;
            $review->img_6 = $path_6;
            $review->img_7 = $path_7;
            $review->img_8 = $path_8;
            $review->img_9 = $path_9;
            $review->img_10 = $path_10;

            $review->save();

            if ($path_1 != null) { $path_1->store('products', 'public'); }
            if ($path_2 != null) { $path_2->store('products', 'public'); }
            if ($path_3 != null) { $path_3->store('products', 'public'); }
            if ($path_4 != null) { $path_4->store('products', 'public'); }
            if ($path_5 != null) { $path_5->store('products', 'public'); }
            if ($path_6 != null) { $path_6->store('products', 'public'); }
            if ($path_7 != null) { $path_7->store('products', 'public'); }
            if ($path_8 != null) { $path_8->store('products', 'public'); }
            if ($path_9 != null) { $path_9->store('products', 'public'); }
            if ($path_10 != null) { $path_10->store('products', 'public'); }

            return redirect(route('admProducts'));
        }
        catch(Exception $e) 
        { 
            echo $e->getMessage(); 
        }
    }

    public function admCategoriesChar($id)
    {
        if (session('admin') != null)
        {
            return view('admin.char', [
                'admin'=>session('admin'),
                'accessLevel'=>session('accessLevel'),
                'category'=>Categories::find($id),
                'charList'=>CharOfCat::where('category', '=', $id)->get()
            ]);
        }
    }




    //Dev
    // public function reg()
    // {
    //     return view('admin.reg');
    // }

    // public function regCheck(Request $req)
    // {
    //     $review = new Admin();
    //     $review->login = $req->input('login');
    //     $review->password = $req->input('password');
    //     $review->accessLevel = 1;

    //     $review->save();
    // }
}
