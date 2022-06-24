<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
        $data = Categories::all();

        return view('admin.category', [
                'admin'=>session('admin'), 
                'accessLevel'=>session('accessLevel'),
                'data'=>$data
        ]);
    }

    public function products()
    {
        return view('admin.products', ['admin'=>session('admin'), 'accessLevel'=>session('accessLevel')]);
    }

    public function addCategory(Request $request)
    {
        $review = new Categories();
        $review->tittle = $request->input('tittle');
        $review->save();

        return redirect(route('admCategories'));
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
