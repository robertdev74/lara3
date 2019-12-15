<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Product;
use DB;

class MainController extends Controller
{
    public function index(){
        return view('public.master');
    }

    public function getCategories(){
    	$categories = Category::where('cat_status', 1)->get();
        return response()->json($categories);
    }

    public function getFeaturedProducts(){
    	$featuredProduct = Product::where('status',1)
    					->limit(3)
    					->get();

    	//return $featuredProduct;
    	return response()->json($featuredProduct);
    }

    public function getNewProducts(){
    	$newProduct = Product::where('status', 1)
    				->orderBy('id', 'desc')
    				->limit(8)
    				->get();
    	//return $featuredProduct;
    	return response()->json($newProduct);
    }

    public function getCatProducts($id){
        $catProduct = Product::where('cat_id', $id)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get();
        //return $catProduct;
        return response()->json($catProduct);
    }

    public function getProductDetails($id){
        $Product = DB::table('products')
                    ->join('categories','products.cat_id', '=', 'categories.id')
                    ->where('products.id','=', $id)
                    ->select('products.*','categories.cat_name')
                    ->first();
        
        //$data = $Product->toArray();
        //var_dump($Product);
        return response()->json($Product);
    }
}
