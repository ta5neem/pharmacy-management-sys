<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BuyBillProduct;
use Carbon\Carbon;
use App\Models\payment;
use App\Models\BuyBill;
use App\Models\BuyOrder;
use App\Models\BuyProduct;
use App\Models\MedicalSupply;
use App\Models\Medicine;
use App\Models\MedicalFood;
use App\Models\CosmeticProduct;
use App\Models\Warehouse;
use App\Inventory;
use App\PharmacyBranch\Branch;
use App\User;
use DB;

class InventoryController extends Controller
{

    public function __construct()
   {
       $this->middleware('auth');
   }

    public function showaddview()
    {
      return view('dashboard.inventory.add');
    }

      public function store(Request $request)
      {
        $inventory =new Inventory;
        $inventory->product_amount=$request->product_amount;
        $inventory->Product_id=$request->product_id;
        $inventory->save();
        return back();
      }

      public function all()
      {  $inventories =DB::table('branches')
        ->where('type', 0)->whereNull('deleted_at')
        ->get();
         $title = 'All Inventories';
         return view('dashboard.inventory_list',compact('inventories','title'));
      }

      public function  ProductQuantities($id)
      {
        $product=DB::table('buy_bill_products')
        ->join('buy_bills','buy_bills.id','buy_bill_products.buy_bill_id')
        ->join('buy_orders', 'buy_orders.id' ,'buy_bills.buy_order_id')
        ->join('users','users.id' ,'buy_orders.user_id')
        ->where('users.branch_id', $id)
        ->join('branches','branches.id' ,'users.id')
        ->select('buy_bill_products.id')
        ->get();
        $title = 'Product Quantities';
        if(  $product[0] != null)
      {  $bt=BuyBillProduct::where('id',$product[0]->id);
         $i=0;
         foreach ($product as $one) {
           $at=BuyBillProduct::where('id',$product[$i]->id);
           $bt->union($at);
           $i++;
           $buybillproduct=$bt->get();}
         }
        //$buybillproduct=$bt->get();}
      //  return $buybillproduct;

        //return \App\Models\BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',22)->value('product_id');
        return view('dashboard.display_inventory_products',compact('buybillproduct','title'));


      }

    public function delete($id)
      {
        $inventory=Branch::where('id',$id)->first();
        $inventory->delete();
        return back(); }

    public function TransferOrder()
      {
        $user=Auth::user()->id;
        $medicine=Medicine::select('generic_name as name');
        $MedicalSupply=MedicalSupply::select('name');
        $MedicalFood=MedicalFood::select('name');
        $CosmeticProduct=CosmeticProduct::select('name');

        $inventories=Branch::select('*')->where('type',0)->get();
        //return $inventories;
        $allproducts=$MedicalFood->union($MedicalSupply)->union($medicine)->union($CosmeticProduct)->get();
        //return $allproducts;
        return view('dashboard.add_order_transferring_inventory',compact('user','allproducts','inventories'));

      }
      public function send_order_transfer($id)
    {
      $buy_products=BuyProduct::select('*')->where('buy_order_id',$id)->get();
      $br= BuyProduct::join('buy_orders','buy_orders.id','buy_products.buy_order_id')
      ->join('users','users.id','buy_orders.user_id')->
      join('branches','branches.id','users.id')->where('buy_products.buy_order_id',$id)->value('branches.id');
      $branch=Branch::where('id',$br)->value('name');

      $medicine=Medicine::select('generic_name as name','product_id');
      $MedicalSupply=MedicalSupply::select('name','product_id');
      $MedicalFood=MedicalFood::select('name','product_id');
      $CosmeticProduct=CosmeticProduct::select('name','product_id');
      $allproducts=$MedicalFood->union($MedicalSupply)->union($medicine)->union($CosmeticProduct)->get();
    // return $allproducts;
      return view('dashboard.send_ordered_transferring',compact('buy_products','branch','id','allproducts'));

    }

  public function do_the_send(Request $request)
  {
    return back();


  }

      public function storeTheOrder(Request $request)
      {
        $buyordr =new BuyOrder;
        //return $request->warehouse_id;
        $buyordr->order_date=$request->order_date;
        $buyordr->user_id=Auth::user()->id;

        $buyordr->warehouse_id=Branch::select('id')->where('name',$request->warehouse_id)->value('id');
        //return   $buyordr->warehouse_id;
          $buyordr->type=2 ;

        $buyordr->save();
        $total_sum =0 ;
        for( $i=0; $i<count($request->quantity); $i++)
         {
           $buyproduct[$i] =new BuyProduct;
           $buyproduct[$i]->quantity_order=$request->quantity[$i];
           $buyproduct[$i]->product_id=Medicine::where('generic_name',$request->product_id[$i])->value('product_id');
           if($buyproduct[$i]->product_id==null)
              $buyproduct[$i]->product_id=MedicalSupply::where('name',$request->product_id[$i])->value('product_id');
           if($buyproduct[$i]->product_id==null)
             $buyproduct[$i]->product_id=MedicalFood::where('name',$request->product_id[$i])->value('product_id');
          if($buyproduct[$i]->product_id==null)
               $buyproduct[$i]->product_id=CosmeticProduct::where('name',$request->product_id[$i])->value('product_id');

           $buyproduct[$i]->Buy_order_id= $buyordr->id;
           $tot_item[$i]=$request->Quantity[$i]*$request->individual_price[$i];
           $buyproduct[$i]->save();
         }
       //return  $buyordr->warehouse_id;
           $buyordr->save();
        return back();}




      public function TransferingOrderList()
      {
        $user=Auth::user()->id;
        $inventory=User::select('branch_id')->where('id',$user)->value('branch_id');

        $buyordr=BuyOrder::where('type',2)->where('warehouse_id',$inventory)->get();
        return view('dashboard.transferring_order_list',compact('buyordr'));
      }


      public function edit($id)
      {   $inventory =Inventory::find($id);
          return view('dashboard.inventory.edit',compact('inventory'));}


      public function update($id,Request $request)
      { $inventories =Inventory::find($id);

        $inventories->product_amount=$request->product_amount;
        $inventories->Product_id=$request->product_id;
        $inventories->save();
        //app()->call('App\Http\Controllers\InventoryController@all');
        return back();
        //return $this ->all();
      }

}
