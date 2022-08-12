<?php

namespace App\Http\Controllers\Product;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Models\BookIn;
use App\Models\BuyBillProduct;
use App\Models\CosmeticProduct;
use App\Models\MedicalFood;
use App\Models\MedicalSupply;
use App\Models\Medicine;
use App\Models\ProductPlace;
use App\Traits\ProductTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransformController extends Controller
{
    use ProductTrait;

     public function showAllInventory()
    {
        $inventories = Branch::join('type_branches', 'type_branches.id', '=', 'branches.type_id')
            ->where('type_branches.type', 'inventory')
            ->select('branches.id', 'name', 'email', 'location_id')
            ->get();

        return view('product.transform.inventory_list', compact('inventories'));
    }

     public function showProduct($inventory_id)
     {
           $pharmacies = Branch::join('type_branches', 'type_branches.id', '=', 'branches.type_id')
             ->where('type_branches.type', 'pharmacy')
             ->select('branches.id', 'name', 'email', 'location_id')
             ->get();

           $medicines =  $this ->getProductInInventory(new Medicine())
            ->where('users.branch_id',$inventory_id)
            ->select('buy_bill_products.id', 'available_quantity', 'expired_date', 'purchasing_price', 'selling_price',
                'image','generic_name as name');

           $medicalFoods =  $this ->getProductInInventory(new MedicalFood())
             ->where('users.branch_id',$inventory_id)
             ->select('buy_bill_products.id','available_quantity', 'expired_date', 'purchasing_price', 'selling_price',
                 'image', 'medical_foods.name');

          $medicalSupplies =  $this ->getProductInInventory(new MedicalSupply())
             ->where('users.branch_id',$inventory_id)
             ->select('buy_bill_products.id', 'available_quantity', 'expired_date', 'purchasing_price', 'selling_price',
                  'image', 'medical_supplies.name');

          $cosmeticProducts =  $this ->getProductInInventory(new CosmeticProduct())
             ->where('users.branch_id',$inventory_id)
             ->select('buy_bill_products.id', 'available_quantity', 'expired_date', 'purchasing_price', 'selling_price',
                  'image', 'cosmetic_products.name');


          $products = $medicines->union($medicalFoods)->union($medicalSupplies)->union($cosmeticProducts)->get();

            return view('product.transform.display_inventory_products', compact('products','pharmacies'));
     }


    public function transform(Request $request)
    {
        $place = ProductPlace::create([

            'closet'=> $request->closet,
            'rack'=> $request->rack,
            'drawer'=> $request->drawer,
        ]);

        BookIn::create([

            'quantity'=> $request->quantity,
            'amount'=>$request->quantity,
            'branch_id'=> $request->branch_id,  //select
            'product_place_id'=> $place->id,
            'buy_bill_product_id'=>$request->buy_bill_product_id,
            'date'=>Carbon::today(),
        ]);

//        $buyBillProduct = BuyBillProduct::find($buy_bill_product_id);
//        $buyBillProduct->update(['available_quantity'=>'available_quantity'-$request->quantity]);
    }


}
