<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\CosmeticProductRequest;
use Illuminate\Http\Request;
use App\Models\CosmeticProduct;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Traits\ProductTrait;

class CosmeticProductController extends Controller
{
    use ProductTrait;

    public function create()
    {
        //view form to creat the cosmetic product
        return view('product.cosmeticProduct.addCosmeticProduct');
    }

    public function store(CosmeticProductRequest $request)
    {
        //save photo in folder.
        $file_name = $this -> saveImage($request -> image , 'images/products');

        //save cosmetic product into database
        $product = Product::create([
            'image'=> $file_name,
            'bar_code'=> $request->bar_code,
            'product_country'=> $request->product_country,
            'manufacturer_company'=>$request->manufacturer_company,
            'is_active'=>$request->radio,
        ] );

        CosmeticProduct::create([
            'name'=> $request->name,
            'product_id'=> $product->id,
            'ingredients'=>$request->ingredients,
            'description'=>$request->description,
        ]);
        return redirect()->back();
    }

    public function getAll()
     {
         $user = auth()->user();

         $cosmeticProducts = $this -> getProductInPharmacy(new CosmeticProduct())
//            ->where('books_in.amount', '!=', '0')
            ->where('books_in.branch_id', $user->branch_id)
            -> select('cosmetic_products.id', 'name', 'ingredients',
                'description', 'image', 'bar_code',
                'product_country', 'manufacturer_company')->distinct()
            ->get();
       return  view('product.cosmeticProduct.cosmeticProducts_list', compact('cosmeticProducts')) ;
        }

    public function getAllGrid()
    {
        $count = 0;
        $user = auth()->user();

        $cosmeticProducts = $this -> getProductInPharmacy(new CosmeticProduct())
            ->where('books_in.amount', '!=', '0')
            ->where('books_in.branch_id', $user->branch_id)
            ->select('books_in.id', 'name',
            'image', 'selling_price', 'amount', 'expired_date')->get();

        return view('product.cosmeticProduct.cosmetics_grid', compact('cosmeticProducts', 'count'));
    }

    public function showDetails($id)
    {
       // $user = auth()->user();
        $details = $this -> getProductInPharmacy(new CosmeticProduct())

            ->where('books_in.id', $id)
            ->select('cosmetic_products.id', 'name', 'ingredients', 'description', 'product_country',
            'manufacturer_company', 'image', 'bar_code',
            'name_warehouse', 'selling_price', 'purchasing_price', 'expired_date',
            'production_date', 'amount', 'product_place_id', 'books_in.date')->get();

        return view('product.cosmeticProduct.show_details', compact('details'));
    }

    public function showBatches($id)
    {
        //$user = auth()->user();
        $batches =  $this -> getProductInPharmacy(new CosmeticProduct())
            ->where('cosmetic_products.id', $id)
            ->select('books_in.id', 'name', 'name_warehouse', 'selling_price', 'purchasing_price', 'expired_date',
            'production_date', 'amount', 'product_place_id', 'books_in.date')->get();

        return view('product.cosmeticProduct.show_batches', compact('batches'));
    }

    public function edit($id)
    {

        //search id cosmetic product.
        $cosmeticProduct = CosmeticProduct::find($id);
        if(!$cosmeticProduct)
            return redirect()->back() ;
        $cosmeticProduct = CosmeticProduct::with('product')->find($id);
        return view('product.cosmeticProduct.editCosmeticProduct', compact('cosmeticProduct'));
    }

    public function update(Request $request, $id)
    {
        //check if cosmetic product. exist.
        $cosmeticProduct = CosmeticProduct::find($id);

        $cosmeticProduct::with('product')->get();

        $product = Product::find($cosmeticProduct->product_id);

        if(!$cosmeticProduct)
            return redirect() -> back() ;

        //update data.
         $cosmeticProduct->update($request->all());
         $product->update($request->all());
        return redirect()->back();
    }

    public function delete($id)
    {
        //check if id cosmetic product exist.
        $cosmeticProduct = CosmeticProduct::find($id);
        if(!$cosmeticProduct)
            return redirect()->back();

        //delete the cosmetic product.
        $cosmeticProduct -> delete();
        return redirect()->back();
    }

}
