<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalFoodRequest;
use Illuminate\Http\Request;
use App\Models\MedicalFood;
use App\Models\Product;
use App\Traits\ProductTrait;

class MedicalFoodController extends Controller
{
    use ProductTrait;

    public function create()
    {
        //view form to creat the medical food
        return view('product.medicalFood.addMedicalFood');
    }

    public function store(MedicalFoodRequest $request)
    {
        //save photo in folder.
        $file_name = $this -> saveImage($request -> image , 'images/products');

        //save medical food into database
         $product = Product::create([
            'image'=> $file_name,
            'bar_code'=> $request->bar_code,
            'product_country'=> $request->product_country,
            'manufacturer_company'=>$request->manufacturer_company,
             'is_active'=>$request->radio,
        ] );

        MedicalFood::create([
            'name'=> $request->name,
            'product_id'=> $product->id,
            'storage' => $request->storage,
            'adverse_effects' => $request->adverse_effects,

        ]);
        return redirect()->back()->with(['success'=>'تم الإضافة بنجاح']);
    }

    public function getAll()
    {
        $user = auth()->user();

        $medicalFoods =  $this -> getProductInPharmacy(new MedicalFood())
//            ->where('books_in.amount', '!=', '0')
            ->where('books_in.branch_id', $user->branch_id)
            -> select('medical_foods.id', 'name', 'adverse_effects',
            'storage', 'image', 'bar_code',
            'product_country', 'manufacturer_company')->distinct()->get();

       return view('product.medicalFood.medicalFoods_list', compact('medicalFoods')) ;
    }

    public function getAllGrid()
    {
        $count = 0;
        $user = auth()->user();

        $medicalFoods = $this -> getProductInPharmacy(new MedicalFood())

            ->where('books_in.amount', '!=', '0')
            ->where('books_in.branch_id', $user->branch_id)
            ->select('books_in.id', 'name',
            'image', 'selling_price', 'amount', 'expired_date')->get()->groupBy('name');

        return view('product.medicalFood.medicalFood_grid', compact('medicalFoods', 'count'));
    }

    public function showDetails($id)
    {
        $details = $this -> getProductInPharmacy(new MedicalFood())

            ->where('books_in.id', $id)
            ->select('medical_foods.id', 'name', 'storage', 'adverse_effects', 'product_country', 'manufacturer_company', 'image', 'bar_code',
            'name_warehouse', 'selling_price', 'purchasing_price', 'expired_date',
            'production_date', 'amount', 'product_place_id', 'books_in.date')->get();

        return view('product.medicalFood.show_details', compact('details'));
    }

    public function showBatches($id)
    {
       // $user = auth()->user();
        $batches = $this -> getProductInPharmacy(new MedicalFood())

            ->where('medical_foods.id', $id)
            ->select('books_in.id', 'name', 'name_warehouse', 'selling_price', 'purchasing_price', 'expired_date',
            'production_date', 'amount', 'product_place_id', 'books_in.date')->get();

        return view('product.medicalFood.show_batches', compact('batches'));
    }

    public function edit($id)
    {
        //search id medical food.
        $medicalFood = MedicalFood::find($id);
        if(!$medicalFood)
            return redirect()->back() ;
        $medicalFood = MedicalFood::with('product')->find($id);
        return view('product.medicalFood.editMedicalFood', compact('medicalFood'));
    }

    public function update(Request $request, $id)
        {
            //check if medical food exist.
            $medicalFood = MedicalFood::find($id);

            $medicalFood::with('product')->get();

            $product = Product::find($medicalFood->product_id);

            if(!$medicalFood)
                return redirect() -> back() ;

            //update data.
             $medicalFood->update($request->all());
             $product->update($request->all());
            return redirect()->back();
        }

    public function delete($id)
    {
        //check if id medical food exist.
        $medicalFood = MedicalFood::find($id);
        if(!$medicalFood)
            return redirect()->back();

        //delete the medical food.
        $medicalFood -> delete();
        return redirect()->back();
    }

}
