<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalSupplyRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MedicalSupply;
use App\Models\Product;
use App\User;
use App\Traits\ProductTrait;

class MedicalSupplyController extends Controller
{
    use ProductTrait;

    public function create()
    {
        $user = auth()->user();
            //view form to creat the medical supply
        return view('product.medicalSupply.addMedicalSupply', compact('user'));
    }

    public function store(MedicalSupplyRequest $request)

    {
            //save photo in folder.
        $file_name = $this -> saveImage($request -> image , 'images/products');

            //save medical supply into database

        $product = Product::create([
            'image'=> $file_name,
            'bar_code'=> $request->bar_code,
            'product_country'=> $request->product_country,
            'manufacturer_company'=>$request->manufacturer_company,
            'is_active'=>$request->radio,
        ] );

            MedicalSupply::create([
            'name'=> $request->name,
            'product_id'=> $product->id,
            'use_to' => $request->use_to,
        ]);
            return redirect()->back();
    }

    public function getAll()
     {
         $user = auth()->user();

        $medicalSupplies =  $this -> getProductInPharmacy(new MedicalSupply())
        ->where('books_in.branch_id', $user->branch_id)
        -> select('medical_supplies.id', 'name', 'use_to', 'image', 'bar_code',
             'product_country', 'manufacturer_company')->distinct()->get();

       return view('product.medicalSupply.medicalSupplies_list', compact('medicalSupplies')) ;

    }

    public function getAllGrid()
    {
        $count = 0;
        $user = auth()->user();

        $medicalSupplies = $this -> getProductInPharmacy(new MedicalSupply())

            ->where('books_in.amount', '!=', '0')
            ->where('books_in.branch_id', $user->branch_id)
            ->select('books_in.id', 'name',
            'image', 'selling_price', 'amount', 'expired_date')->get();

        return view('product.medicalSupply.medicalSupply_grid', compact('medicalSupplies', 'count'));
    }

    public function showDetails($id)
    {
        //$user = auth()->user();

        $details = $this -> getProductInPharmacy(new MedicalSupply())
            ->where('books_in.id', $id)
            ->select('medical_supplies.id', 'name', 'use_to', 'product_country', 'manufacturer_company', 'image', 'bar_code', 'name_warehouse', 'selling_price', 'purchasing_price', 'expired_date',
            'production_date', 'amount', 'product_place_id', 'books_in.date')->get();

        return view('product.medicalSupply.show_details', compact('details'));
    }

    public function showBatches($id)
    {
       // $user = auth()->user();
        $batches = $this -> getProductInPharmacy(new MedicalSupply(),$user)
            ->where('medical_supplies.id', $id)
            ->select('books_in.id', 'name', 'name_warehouse', 'selling_price', 'purchasing_price', 'expired_date',
            'production_date', 'amount', 'product_place_id', 'books_in.date')->get();

        return view('product.medicalSupply.show_batches', compact('batches'));
    }

    public function edit($id)
    {
        //search id medical supply.
        $medicalSupply = MedicalSupply::find($id);
        if(!$medicalSupply)
            return redirect()->back() ;
        $medicalSupply = MedicalSupply::with('product')->find($id);
        return view('product.medicalSupply.editMedicalSupply', compact('medicalSupply'));
    }

    public function update(Request $request, $id)
    {
        //check if medical supply exist.
        $medicalSupply = MedicalSupply::find($id);

        $medicalSupply::with('product')->get();

        $product = Product::find($medicalSupply->product_id);

        if(!$medicalSupply)
            return redirect() ->back() ;

        //update data.
         $medicalSupply->update($request->all());
         $product->update($request->all());
        return redirect()->back();
    }

    public function delete($id)
        {
            //check if id medical supply exist.
            $medicalSupply = MedicalSupply::find($id);
            if(!$medicalSupply)
                return redirect()->back();

            //delete the medical supply.
            $medicalSupply -> delete();
            return redirect()->back();
        }
}



