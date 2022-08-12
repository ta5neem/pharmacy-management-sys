<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BuyOrder;
use App\Models\BuyProduct;
use App\Models\BuyBillProduct;
use App\Models\BuyBill;
use App\Models\Warehouse;
use App\Models\MedicalSupply;
use App\Models\Medicine;
use App\Models\CosmeticProduct;
use App\Models\Product;
use App\User;
use App\Branch;
use DB;
use App\Models\MedicalFood;
use Carbon\Carbon;


class BuyorderController extends Controller
{

  public function __construct()
 {
     $this->middleware('auth');
 }

  public function showaddview()
  { //$medicine=Medicine::all();
      $user=Auth::user()->id;
      $warhouses=Warehouse::select('name')->get();
      $medicine=Medicine::select('generic_name as name');
      $MedicalSupply=MedicalSupply::select('name');
      $MedicalFood=MedicalFood::select('name');
      $CosmeticProduct=CosmeticProduct::select('name');
      $product=Product::select('id')->get();
      $b=BuyOrder::select('id')->count('id');
      return   $MedicalSupply;
      $allproducts=$MedicalFood->union($MedicalSupply)->union($medicine)->union($CosmeticProduct)->get();
      //return  $MedicalFood->get();
      //return $allproducts;
    //return   $b;
  //  return $warhouses;
  //  return Auth::user()->id;add_order
    return view('dashboard.add_order_to_warehouse',compact( 'warhouses','medicine','MedicalSupply','MedicalFood','user','allproducts'));
    //return view('dashboard.buyorder.add',compact( 'user' ));
   }

public function all_required_order()
{ $user=Auth::user()->id;
  $thisbranch=DB::table('users')
  ->join('branches','branches.id','=','users.branch_id')
  ->where('users.id',$user)
  ->value('branches.id');
     $title = 'All BuyOrder';
    // return $title,$thisbranch;
  $buyorder=BuyOrder::where('warehouse_id',$thisbranch)->where('type',2)->orWhere('type',3)->get();
  return view('dashboard.buyorder.required_order',compact( 'buyorder' ,'title'));


}
public function store_after_send(Request $request)
{


}

public function send_order($id)
{

   $buybillproduct=BuyBillProduct::join('buy_products','buy_bill_products.buy_product_id','=','buy_products.id')
    ->join('buy_orders', 'buy_products.buy_order_id' ,'=','buy_orders.id')
    ->where('buy_products.buy_order_id','=',$id)
    ->get();

    $branch=User::join('branches','users.branch_id','=','branches.id')
      ->where('users.id',$buybillproduct[0]->user_id)->get();

  $title = 'All BuyOrder';
  //return $buybillproduct[0]->buy_order_id;
  return view('dashboard.buyorder.send_request',compact( 'buybillproduct' ,'branch'));

}




    public function store(Request $request)
    {
      $buyordr =new BuyOrder;

      $buyordr->order_date=$request->order_date;
      $buyordr->user_id=Auth::user()->id;

      $buyordr->warehouse_id=Warehouse::select('id')->where('name',$request->warehouse_id)->value('id');
      $buyordr->type=1 ;

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
      return back();
    }

    public function all()
    {
       $buyordr = BuyOrder::select('*')->whereNull('deleted_at')->get();
       $title = 'All BuyOrder';
       $User=User::select('*')->get();
      return view('dashboard.buyorder.all',compact('buyordr','title','User'));
    }


   public function all_warehose_order()
   {

     $buyordr = BuyOrder::select('*')->where('type',1)->whereNull('deleted_at')->get();
    //  return $buyordr;
     $title = 'All BuyOrder';
     $User=User::select('*')->get();
     return view('dashboard.warehouse_order_list',compact('buyordr','User'));
  }


     public function all_inventory_order()
     {

       $buyordr = BuyOrder::select('*')->where('type',2)->whereNull('deleted_at')->get();
        //return $buyordr;
       $title = 'All BuyOrder';
       $User=User::select('*')->get();
       return view('dashboard.inventory_order_list',compact('buyordr','User'));
    }



    public function delete($id)
    {
      $BuyOrder=BuyOrder::where('id',$id)->first();
      $buyproduct=BuyProduct::select('*')->where('Buy_order_id',$id)->get();

      $BuyOrder->deleted_at=Carbon::now()->format('Y-m-d');
      foreach ($buyproduct as $key) {
        $key->deleted_at=Carbon::now()->format('Y-m-d');
        $key->save();
        //return $key->deleted_at;
      }
     //$buyproduct->delete();
    // return $BuyOrder->deleted_at('Y')-3;
       //if($BuyOrder->deleted_at->date('Y-m-d-3')<$BuyOrder->order_date)
          $BuyOrder->save();
      return back();
    }

    public function edit($id)
              {
                  $buyordr =BuyOrder::find($id);
                //  $buyproduct =new BuyProduct;
                  $i =0 ;
                  $buyproduct =BuyProduct::select('*')->where('Buy_order_id',$id)->get();
                  return view('dashboard.Edit_order_from_ware',compact('buyordr','buyproduct','i'));
              }

    public function update($id,Request $request)
            { $buyordr =BuyOrder::find($id);
              $buyordr->order_date=$request->order_date;
              $buyordr->Number_Of_product=$request->Number_Of_product;
              $buyordr->user_id=$request->user_id;
              $buyordr->Inventory_id=$request->Inventory_id;
              $buyordr->total_price=$request->total_price;
              $buyordr->warehouse_id=$request->warehouse_id;
              $buyordr->save();
              $total_sum=0;
             for($i=0;$i<$request->Number_Of_product;$i++)
               {
                 $buyproduct[$i] =BuyProduct::select('*')->where('Buy_order_id',$id)->first();
                 $buyproduct[$i]->Quantity=$request->Quantity[$i];
                 $buyproduct[$i]->product_id=$request->product_id[$i];
                 $buyproduct[$i]->individual_price=$request->individual_price[$i];
                 $buyproduct[$i]->Buy_order_id= $buyordr->id;
                 $tot_item[$i]=$request->Quantity[$i]*$request->individual_price[$i];
                 $buyproduct[$i]->save();
                 $total_sum += $tot_item[$i];

                }

                $buyordr->total_price=$total_sum;
                $buyordr->save();
            return back();
          }


public function reportsearch(Request $request)
{
    $start = $request ->start;
    $end = $request ->end;
    $paid_of_order=BuyBill::select('*')->whereBetween('recieve_date',[$start,$end])->sum('total_payment');
    $num_order=Buyorder::select('*')->whereBetween('order_date',[$start,$end])->count('id');
    $value_of_order=BuyBill::select('*')->whereBetween('recieve_date',[$start,$end])->sum('total_price');
    $num_of_product=Product::select('*')->count('id');
    $buyordr=BuyOrder::whereBetween('order_date',[$start,$end])->where('type',1)->whereNull('deleted_at')->get();
     return view('dashboard.warehouse_orders_report',compact('paid_of_order','num_order','value_of_order','num_of_product','buyordr'));
}



public function paid_search()
{

  $paid_of_order=BuyBill::select('*')->sum('total_payment');
  $num_order=Buyorder::select('*')->count('id');
  $value_of_order=BuyBill::select('*')->sum('total_price');


  $buybill = DB::table('buy_bills')->select('buy_order_id')
      ->whereColumn('total_price','=' ,'total_payment')
      ->get();

    $b=buyOrder::select('*')->where('id',$buybill[0]->buy_order_id);
    $i=0;
    foreach ($buybill as $key ) {

      $a=buyOrder::select('*')->where('id',$buybill[$i]->buy_order_id);
      $b->union($a);
        $i++;

    }
    $buyordr=$b->get();
       return view('dashboard.warehouse_orders_report',compact('paid_of_order','num_order','value_of_order','buyordr'));

}


public function Non_paid_search()
{

  $paid_of_order=BuyBill::select('*')->sum('total_payment');
  $num_order=Buyorder::select('*')->count('id');
  $value_of_order=BuyBill::select('*')->sum('total_price');
  $num_of_product=Product::select('*')->count('id');
  $buybill = DB::table('buy_bills')->select('buy_order_id')
      ->whereColumn('total_price','>' ,'total_payment')
      ->get();

    $b=buyOrder::select('*')->where('id',$buybill[0]->buy_order_id);
    $i=0;
    foreach ($buybill as $key ) {

      $a=buyOrder::select('*')->where('id',$buybill[$i]->buy_order_id);
      $b->union($a);
        $i++;

    }
    $buyordr=$b->get();
       return view('dashboard.warehouse_orders_report',compact('paid_of_order','num_order','value_of_order','num_of_product','buyordr'));

}


public function search(Request $request)
            {
              $rdio = $request->rdio;

              {
                $start_at = $request ->start_at;
                $end_at = $request ->end_at;
                $title=$request->type;
              //  return $request->start_at;
                $buyordr=BuyOrder::whereBetween('order_date',[$start_at,$end_at])->where('type',1)->whereNull('deleted_at')->get();

                return view('dashboard.warehouse_order_list',compact('buyordr','title'));
              }

          }


public function transfer_order_search(Request $request)
          {
            $rdio = $request->rdio;

            {
              $start_at = $request ->start_at;
              $end_at = $request ->end_at;
              $title=$request->type;
            //  return $request->start_at;
              $buyordr=BuyOrder::whereBetween('order_date',[$start_at,$end_at])->where('type',2)->whereNull('deleted_at')->get();

              return view('dashboard.inventory_order_list',compact('buyordr','title'));
            }

        }





}
