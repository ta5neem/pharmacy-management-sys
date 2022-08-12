<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\BookIn;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        //view form to create the category
        return view('product.category.addCategory');
    }

    public function store(CategoryRequest $request)
    {
        //save category into database
        Category::create([
            'name_category' => $request->name_category,
        ]);
        return redirect()->back();
    }

    public function getAll()
    {
        $user = auth()->user();

        $categories = BookIn::join('buy_bill_products', 'books_in.buy_bill_product_id', '=', 'buy_bill_products.id')
            ->join('buy_products', 'buy_bill_products.buy_product_id', '=', 'buy_products.id')
            ->join('products', 'buy_products.product_id', '=', 'products.id')
            ->join('medicines', 'products.id', '=', 'medicines.product_id')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->where('books_in.branch_id', $user->branch_id)
            ->whereNull('categories.deleted_at')
            ->select('categories.id','name_category')->distinct()->get();

        return view('product.category.showCategories', compact('categories'));
    }

    public function edit($id)
    {
        //search id category.
        $category = Category::find($id);
        if(!$category)
            return redirect()->back() ;
        $category = Category::select('id', 'name_category')->find($id);
        return view('product.category.editCategory', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        //check if category exist.
        $category = Category::find($id);
        if(!$category)
            return redirect() -> back() ;

        //update data.
        $category -> update($request->all());
        return redirect()->back();
    }

    public function delete($id)
    {
        //check if id category exist.
        $category = Category::find($id);
        if(!$category)
            return redirect()->back();

        //delete the category.
        $category  -> delete();
        return redirect()->back();

    }


}
