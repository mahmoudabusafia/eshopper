<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::limit(10)->get();
        return view('web.index', [
            'products' => $products,
        ]);
    }

//    public function shop()
//    {
//        $products = Product::paginate(9);
//        return view('web.shop', [
//            'products' => $products,
//        ]);
//    }
    public function shop(Request $request)
    {
        $price = $request->input('price');
        $color = $request->input('color');
        $size = $request->input('size');
        $search = $request->input('search');

        //You should validate these inputs your way

        $query = Product::query();

        if (!empty($price) && $price != '*') {
            //We should filter gender
            $query->where('price', '<=', ($price*100))->where('price', '>=', ( ($price-1)*100));
        }

        if (!empty($search)) {
            //We should filter gender
            $query->where('name', 'LIKE' ,"%{$search}%");
        }

//        if (!empty($status)) {
//            //We should filter status too
//            $query->where('status', $status);
//        }
//
//        if (!empty($age)) {
//            //Filter by age
//            $query->where('age', $age);
//        }

        $products = $query->paginate(9);
        return view('web.shop', [
            'products' => $products,
        ]);
    }

    public function filter()
    {
        return Product::all();
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function checkout()
    {
        return view('web.checkout');
    }
    public function login()
    {
        return view('web.auth.login');
    }
    public function register()
    {
        return view('web.auth.register');
    }

    public function show($id){
        $product = Product::findOrfail($id);
        return view('web.product-detail', [
            'product' => $product,
       ]);
    }

    public function cart()
    {
        return view('web.cart');
    }
}
