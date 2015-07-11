<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

use CodeCommerce\Product;
use Illuminate\Http\Request;

class StoreController extends Controller {

	public function index(Category $category){

        $categories = $category->all();

        $featureds = Product::featured()->get();

        $recommendeds = Product::recommended()->get();

        return view('store.index', compact('categories','featureds','recommendeds'));

    }

    public function category($id){

        $categories = Category::all();

        $category = Category::find($id);

        $products = Product::ofCategory($id)->get();

        return view('store.category', compact('categories','products','category'));

    }

    public function product($id){

        $categories = Category::all();

        $product = Product::find($id);

        return view('store.product', compact('categories','product'));
    }
}
