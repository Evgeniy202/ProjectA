<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categories;
use App\Models\CharOfCat;
use App\Models\CharOfProd;
use App\Models\Products;
use App\Models\ValueOfChar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
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

        if ($data != null) {
            session(['admin' => 'true', 'accessLevel' => $data->accessLevel]);
            return redirect('/admin/adm/mainAdm');
        } else {
            return view('admin.login');
        }
    }

    public function mainAdm(Request $request)
    {
        if (session('admin') != null) {
            return view('admin.mainAdm',
                ['admin' => session('admin'), 'accessLevel' => session('accessLevel')]
            );
        } elseif (session(('admin') == null)) {
            return view('admin.login');
        }
    }

    public function categories()
    {
        if (session('admin') != null) {
            return view('admin.category', [
                'admin' => session('admin'),
                'accessLevel' => session('accessLevel'),
                'data' => Categories::all(),
                'charList' => CharOfCat::all()
            ]);
        }
    }

    public function products()
    {
        if (session('admin') != null) {
            return view('admin.products', [
                'admin' => session('admin'),
                'accessLevel' => session('accessLevel'),
                'categoriesList' => Categories::all(),
                'productsList' => Products::all()
            ]);
        }
    }

    public function productOfCategory($categoryId)
    {
        if (session('admin') != null)
        {
            return view('admin.productsOfCategory', [
                'admin' => session('admin'),
                'accessLevel' => session('accessLevel'),
                'category' => Categories::find($categoryId),
                'productsList' => Products::where('category', $categoryId)->paginate(20)
            ]);
        }
    }

    public function admProductDetails($productId)
    {
        if (session('admin') != null)
        {
            $charsList = [];
            $valuesList = [];

            $product = Products::find($productId);
            $charsOfProd = CharOfProd::where('product', $productId)->get();
            $charsOfCategory = CharOfCat::all();
            $values = ValueOfChar::all();

            foreach ($charsOfProd as $charOfProd)
            {
                foreach ($charsOfCategory as $charOfCategory)
                {
                    if ($charOfProd->char == $charOfCategory->id)
                    {
                        array_push($charsList, $charOfCategory);
                    }
                }
                foreach ($values as $value)
                {
                    if ($charOfProd->value == $value->id)
                    {
                        array_push($valuesList, $value);
                    }
                }
            }

            return view('admin.productDetails', [
                'productId'=>$productId,
                'product'=>$product,
                'charsList'=>$charsList,
                'valuesList'=>$valuesList
            ]);
        }
    }

    public function removeProduct($productId, $categoryId)
    {
        $review = Products::find($productId);

        Storage::disk('public')->delete($review->mainImage);
        Storage::disk('public')->delete($review->img_1);
        Storage::disk('public')->delete($review->img_2);
        Storage::disk('public')->delete($review->img_3);
        Storage::disk('public')->delete($review->img_4);
        Storage::disk('public')->delete($review->img_5);
        Storage::disk('public')->delete($review->img_6);
        Storage::disk('public')->delete($review->img_8);
        Storage::disk('public')->delete($review->img_9);
        Storage::disk('public')->delete($review->img_10);

        $review->delete();

        return redirect(route('productOfCategory', $categoryId));
    }

    public function addCategory(Request $request)
    {
        $review = new Categories();
        $review->tittle = $request->input('tittle');
        $review->save();

        return redirect(route('admCategories', [
            'admin' => session('admin'),
            'accessLevel' => session('accessLevel'),
            'categoriesList' => Categories::all(),
            'productsList' => Products::all()
        ]));
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

        $price = (float)str_replace(',', '.', $request->input('price'));

        $isAvailable = $request->input('isAvailable');
        if ($isAvailable != 1) {
            $isAvailable = 0;
        }
        $isFavorite = $request->input('isFavorite');
        if ($isFavorite != 1) {
            $isFavorite = 0;
        }

        $review->category = $request->input('category');
        $review->tittle = $request->input('tittle');
        $review->slug = $request->input('slug');
        $review->description = $request->input('description');
        $review->price = round($price, 2);
        $review->isAvailable = $isAvailable;
        $review->isFavorite = $isFavorite;

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

        if ($path_1 != null) {
            $path_1 = $path_1->store('products', 'public');
        }
        if ($path_2 != null) {
            $path_2 = $path_2->store('products', 'public');
        }
        if ($path_3 != null) {
            $path_3 = $path_3->store('products', 'public');
        }
        if ($path_4 != null) {
            $path_4 = $path_4->store('products', 'public');
        }
        if ($path_5 != null) {
            $path_5 = $path_5->store('products', 'public');
        }
        if ($path_6 != null) {
            $path_6 = $path_6->store('products', 'public');
        }
        if ($path_7 != null) {
            $path_7 = $path_7->store('products', 'public');
        }
        if ($path_8 != null) {
            $path_8 = $path_8->store('products', 'public');
        }
        if ($path_9 != null) {
            $path_9 = $path_9->store('products', 'public');
        }
        if ($path_10 != null) {
            $path_10 = $path_10->store('products', 'public');
        }

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

        $product = Products::latest()->first();

        return redirect(route('addCharToProductView', $product->id));

    }

    public function changeProduct(Request $request, $productId)
    {
        $review = Products::find($productId);

        $price = (float)str_replace(',', '.', $request->input('price'));

        $isAvailable = $request->input('isAvailable');
        if ($isAvailable != 1) {
            $isAvailable = 0;
        }
        $isFavorite = $request->input('isFavorite');
        if ($isFavorite != 1) {
            $isFavorite = 0;
        }

        $review->tittle = $request->input('tittle');
        $review->slug = $request->input('slug');
        $review->description = $request->input('description');
        $review->price = round($price, 2);
        $review->isAvailable = $isAvailable;
        $review->isFavorite = $isFavorite;

        $path = $request->file('mainImg') ?? null;
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

        if (($path != null) && ($path != $review->mainImage)){
            Storage::disk('public')->delete($review->mainImage);
            $path = $path->store('products', 'public');
            $review->mainImage = $path;
        }
        if (($path_1 != null) && ($path_1 != $review->img_1)) {
            $path_1 = $path_1->store('products', 'public');
            $review->img_1 = $path_1;
        }
        if (($path_2 != null) && ($path_2 != $review->img_2)) {
            $path_2 = $path_2->store('products', 'public');
            $review->img_2 = $path_2;
        }
        if (($path_3 != null) && ($path_3 != $review->img_3)) {
            $path_3 = $path_3->store('products', 'public');
            $review->img_3 = $path_3;
        }
        if (($path_4 != null) && ($path_4 != $review->img_4)) {
            $path_4 = $path_4->store('products', 'public');
            $review->img_4 = $path_4;
        }
        if (($path_5 != null) && ($path_5 != $review->img_5)) {
            $path_5 = $path_5->store('products', 'public');
            $review->img_5 = $path_5;
        }
        if (($path_6 != null) && ($path_6 != $review->img_6)) {
            $path_6 = $path_6->store('products', 'public');
            $review->img_6 = $path_6;
        }
        if (($path_7 != null) && ($path_7 != $review->img_7)) {
            $path_7 = $path_7->store('products', 'public');
            $review->img_7 = $path_7;
        }
        if (($path_8 != null) && ($path_8 != $review->img_8)) {
            $path_8 = $path_8->store('products', 'public');
            $review->img_8 = $path_8;
        }
        if (($path_9 != null) && ($path_9 != $review->img_9)) {
            $path_9 = $path_9->store('products', 'public');
            $review->img_9 = $path_9;
        }
        if (($path_10 != null) && ($path_10 != $review->img_10)) {
            $path_10 = $path_10->store('products', 'public');
            $review->img_10 = $path_10;
        }

        $review->save();

        return redirect(route('admProductDetails', $productId));
    }

    public function addCharToProductView($productId)
    {
        if (session('admin') != null) {
            $product = Products::find($productId);
            $prodChars = CharOfProd::where('product', $productId)->orderBy('numberInList', 'asc')->get();
            $chars = CharOfCat::where('category', '=', $product->category)->orderBy('numberInFilter', 'asc')->get();
            $values = ValueOfChar::all();

            return view('admin.addCharToProd', [
                'admin' => session('admin'),
                'accessLevel' => session('accessLevel'),
                'productId'=>$product->id,
                'product'=>$product,
                'charsList'=>$chars,
                'valuesList'=>$values,
                'prodCharsList'=>$prodChars
            ]);
        }
    }

    public function addCharToProduct(Request $request, $productId)
    {
        $review = new CharOfProd();

        $review->product = $productId;
        $review->char = $request->input('char');
        $review->value = $request->input('value');
        $review->numberInList = $request->input('numberInList');
        $review->save();

        return redirect(route('addCharToProductView', $productId));
    }

    public function changeCharToProduct(Request $request, $productId, $prodCharId)
    {
        $newValue = $request->input('changeValue') ?? null;
        $newNumInList = $request->input('numberInList') ?? null;
        $review = CharOfProd::find($prodCharId);
        if (($newValue != null) && ($newValue != $review->value))
        {
            $review->value = $newValue;
        }
        if (($newNumInList != null) && ($newNumInList != $review->numberInList))
        {
            $review->numberInList = $newNumInList;
        }
        $review->save();

        return redirect(route('addCharToProductView', $productId));
    }

    public function removeCharToProduct($productId, $prodCharId)
    {
        CharOfProd::find($prodCharId)->delete();

        return redirect(route('addCharToProductView', $productId));
    }

    public function admCategoriesChar($id)
    {
        if (session('admin') != null) {
            $characteristics = CharOfCat::where('category', '=', $id)->orderBy('numberInFilter', 'asc')->get();

            return view('admin.char', [
                'admin' => session('admin'),
                'accessLevel' => session('accessLevel'),
                'category' => Categories::find($id),
                'charList' => $characteristics,
                'valueList' => ValueOfChar::all()
            ]);
        }
    }

    public function addChar($id, Request $request)
    {
        $rewiev = new CharOfCat();
        $rewiev->category = $id;
        $rewiev->tittle = $request->input('tittle');
        $rewiev->numberInFilter = $request->input('numberInFilter');
        $rewiev->save();

        return redirect(route('admCategoriesChar', $id));
    }

    public function addCharValue(Request $request, $categoryId, $charId)
    {
        $rewiew = new ValueOfChar();
        $rewiew->char = $charId;
        $rewiew->value = $request->input('value');
        $rewiew->numberInFilter = $request->input('numberInFilter');
        $rewiew->save();

        return redirect(route('admCategoriesChar', [
            'id' => $categoryId,
        ]));
    }

    public function changeChar(Request $request, $categoryId, $charId)
    {
        $review = CharOfCat::find($charId);
        $review->tittle = $request->input('tittle');
        $review->save();

        return redirect(route('admCategoriesChar', ['id' => $categoryId]));
    }

    public function removeChar(Request $request, $categoryId, $charId)
    {
        CharOfCat::find($charId)->delete();

        return redirect(route('admCategoriesChar', ['id' => $categoryId]));
    }

    public function admCharValues($categoryId, $charId)
    {
        if (session('admin') != null) {
            $char = CharOfCat::find($charId);
            $values = ValueOfChar::where('char', '=', $charId)->orderBy('numberInFilter', 'asc')->get();
            return view('admin.charValues', [
                'valuesList' => $values,
                'char' => $char,
                'admin' => session('admin'),
                'accessLevel' => session('accessLevel'),
                'categoryId' => $categoryId
            ]);
        }
    }

    public function changeValue(Request $request, $categoryId, $charId, $valueId)
    {
        $review = ValueOfChar::find($valueId);
        $review->value = $request->input('value');
        $review->save();

        return redirect(route('admCharValues', [
            'id'=>$categoryId,
            'charId'=>$charId
        ]));
    }

    public function removeValue($categoryId, $charId, $valueId)
    {
        ValueOfChar::find($valueId)->delete();

        return redirect(route('admCharValues', [
            'id'=>$categoryId,
            'charId'=>$charId
        ]));
    }

    public function addValue(Request $request, $categoryId, $charId)
    {
        $review = new ValueOfChar();
        $review->char = $charId;
        $review->value = $request->input('value');
        $review->numberInFilter = $request->input('numberInFilter');
        $review->save();

        return redirect(route('admCharValues', [
            'id'=>$categoryId,
            'charId'=>$charId
        ]));
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

