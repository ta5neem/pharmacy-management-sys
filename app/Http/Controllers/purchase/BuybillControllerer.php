<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use App\Models\BuyBill;
use Illuminate\Http\Request;
use App\Models\BuyBillProduct;
use App\Models\MedicalSupply;
use App\Models\Medicine;
use Carbon\Carbon;
use App\Models\BuyProduct;
use App\Models\BuyOrder;
use App\Models\CosmeticProduct;
use App\Models\MedicalFood;
use App\Models\payment;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class BuybillControllerer extends Controller
{
  public function __construct()
 {
     $this->middleware('auth');
 }

  public function showaddview($id)
  {// $buyproduct = BuyProduct::select('*')->get();
    $buyproduct=BuyProduct::select('*')->where('buy_order_id',$id)->get();
    $buyorder=BuyOrder::select('*')->where('id',$id)->get();
    $user=Auth::user()->id;


    if(User::where('id',$buyorder[0]->user_id)->value('branch_id')==User::where('id',$user)->value('branch_id'))
    {
    if($buyorder[0]->type==1)
     {
     return view('dashboard.received_from_warehouse',compact('buyproduct','user','id'));}
     else
     {
      $buyproduct = BuyProduct::select('product_id')->where('buy_order_id',$id)->whereNull('deleted_at')->get();
      $buybillproduct1=BuyBillProduct::select('buy_bill_id')
      ->join('buy_products','buy_bill_products.buy_product_id','=','buy_products.id')
      ->where('buy_products.product_id',$buyproduct[0]->product_id);
      $i=0;
      foreach ($buyproduct as $one ) {

        $buybillproduct2=BuyBillProduct::select('buy_bill_id')
        ->join('buy_products','buy_bill_products.buy_product_id','=','buy_products.id')
        ->where('buy_products.product_id',$buyproduct[$i]->product_id);
        $buybillproduct1->union($buybillproduct2);
        $i++;
      }
      $buybillproduct=$buybillproduct1->get();
      $medicine=Medicine::select('generic_name as name','product_id');
      $MedicalSupply=MedicalSupply::select('name','product_id');
      $MedicalFood=MedicalFood::select('name','product_id');
      $CosmeticProduct=CosmeticProduct::select('name','product_id');
      $allproducts=$MedicalFood->union($MedicalSupply)->union($medicine)->union($CosmeticProduct)->get();
      $allproducts->where('product_id',BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',17)->value('product_id'));
       //return BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',16)->get();
    //   return $allproducts;
       return view('dashboard.received_from_inventory',compact('buybillproduct','user' ,'allproducts'));

     }}

     else
     return back();


  }


  public function buybillfromorder($id)
  {   //$buyordr = BuyOrder::select('*')->where('type',1)->whereNull('deleted_at')->get();
    $i=0;
    $buybill=BuyBill::select('*')->where('buy_order_id',$id)->get();


    return view('dashboard.received_warehouse_order_list',compact('buybill'));
  }

    public function store($id,Request $request)
    {
      $buybill =new BuyBill;
    //  return $request->recieve_date;
      $buybill->recieve_date=$request->recieve_date;
      $buybill->total_price=$request->total_price;
      $buybill->buy_order_id=$id;
      $buybill->user_id=Auth::user()->id;
      $buybill->save();
      $total_sum=0;
      $orders=BuyProduct::select('*')->where('Buy_order_id',$id)->get();
      $count =$orders->count();
      //return $orders[0]->product_id;
      $l=0;

     ///return count();
      for($i=0;$i< $count;$i++)

      { if($request->recieve_quantity[$i]+$request->alrady_recieved[$i]<=$request->Quantity[$i] &&$request->recieve_quantity[$i] !=null&&$request->recieve_quantity[$i]!=0)
        {$buybillproduct[$i] =new BuyBillProduct;
        $buybillproduct[$i]->buy_product_id = $orders[$l]->id;
        $buybillproduct[$i]->purchasing_price = $request->individual_price[$i];
        $buybillproduct[$i]->expired_date = $request->expaire_date[$i];
        $buybillproduct[$i]->production_date = $request->production_date[$i];
        $buybillproduct[$i]->quantity_recived= $request->recieve_quantity[$i] ;
        $buybillproduct[$i]->available_quantity=$buybillproduct[$i]->quantity_recived;
        $buybillproduct[$i]->selling_price = $request->payment_price[$i] ;
        $buybillproduct[$i]->buy_bill_id = $buybill->id;
        $buybillproduct[$i]->save(); }
        $l++;
        }

       $buybill->total_payment = $request->total_payment;
       $buybill->save();
       $payment=new payment;
       $payment->buy_bill_id = $buybill->id;
       $payment->payment_price=$request->total_payment;
       $payment->payment_date=$request->recieve_date;
       $payment->save();
      return back();
    }

     public function all_ware_recieved()
     {   $buyordr = BuyOrder::select('*')->where('type',1)->whereNull('deleted_at')->get();
       $i=0;
       $buy=BuyBill::select('*')->where('buy_order_id',$buyordr[0]->id);
       foreach ($buyordr as $one) {
        $a= BuyBill::select('*')->where('buy_order_id',$one->id);
        $buy->union($a);
        $i++;
       }
       $buybill=$buy->get();

      return view('dashboard.received_warehouse_order_list',compact('buybill'));
     }

     public function all_inventory_recieved()
     {
      $buybill = BuyBill::join('buy_orders','buy_orders.id','buy_bills.buy_order_id')
      ->where('buy_orders.Type',2)->get();
      //return $buybill;
      return view('dashboard.received_inventory_order_list',compact('buybill'));
     }



    public function all()
    {  $buybill = BuyBill::all();
       $title = 'All buybill';
       //return $buybill[3];
       return view('dashboard.buybill.all',compact('buybill','title'));
    }

    public function pay($id)
    {  $idd=$id;
       return view('dashboard.buybill.pay',compact('idd'));
    }

    public function store_payment($id,Request $request)
    { //return $id;
      $payment=new payment;
      $buybill = BuyBill::find($id);

      if(($buybill->total_payment+$request->payment)<=$buybill->total_price)
    { $payment->buy_bill_id = $id;
      $payment->payment_price=$request->payment;
      $payment->payment_date=$request->date;
      $buybill->total_payment=$buybill->total_payment+$request->payment;}

      else if(($buybill->total_payment+$request->payment) > $buybill->total_price)
      {
        $payment->payment_price=($buybill->total_price-$buybill->total_payment);
        $buybill->total_payment=$buybill->total_price;
        $payment->buy_bill_id = $id;
        $payment->payment_date=$request->date;
        $buybill2=BuyBill::select('*')->where('buy_order_id',$buybill->buy_order_id)->whereColumn('total_price','>','total_payment')->get();
        $pa=$request->payment;
        $pa=$pa-($payment->payment_price);
        //return $buybill2;
        $i=0;

        foreach ($buybill2 as $key ) {
          if($pa!=0)
        {  $payment1[$i]=new payment;
          if(($key->total_payment+$pa)<=$key->total_price)
            {$key->total_payment+=$pa;
             $payment1[$i]->payment_price=$pa;
             $payment1[$i]->payment_date=$request->date;
             $payment1[$i]->buy_bill_id =$key->id;
             $pa=0;
             //return $payment1[$i]->payment_price;
            }
          else if(($key->total_payment+$pa)>$key->total_price)
              { $payment1[$i]->payment_price=($key->total_price-$key->total_payment);
               $pa=$pa-($payment1[$i]->payment_price);
               $key->total_payment=$key->total_price;
               $payment1[$i]->payment_date=$request->date;
               $payment1[$i]->buy_bill_id =$key->id;
              }
              $payment1[$i]->save();
              $i++;
        }
        $key->save();
      }
      if($pa!=0)////notification
      {}
      }
      if($payment->payment_price!=0)
      $payment->save();
      $buybill->save();
    return back();
    }


    public function return($id)
    {
      $buybill=BuyBill::find($id);
      $billproduct=BuyBillProduct::select('*')->where('buy_bill_id',$id)->get();
      foreach ($billproduct as $key)
      {
        $key->reverse = $key->reverse +($key->Quantity -$key->reverse);
        $key->save();
      }

      $buybill->save();
      return back();

    }

    public function edit($id)
    {   $buybill =BuyBill::find($id);
        return view('dashboard.Edit_recieve order',compact('buybill'));
    }


    public function update($id,Request $request)
    {
      $buybill =BuyBill::find($id);
      $buybill->Number_f_rcieve_order=$request->Number_f_rcieve_order;
      $buybill->expaire_date=$request->expaire_date;
      $buybill->buy_order_id=$request->buy_order_id;
      $buybill->save();

     for($i=0;$i<$buybill->Number_f_rcieve_order;$i++)
       {$buybillproduct =BuyBillProduct::where('id',$buybillproduct->buy_bill_id)->get();
       $buybillproduct->buy_product_id=$request->buy_product_id;
       $buybillproduct->price=$request->price;
       $buybillproduct->Quantity =$request->Quantity ;
       $buybillproduct->buy_bill_id= $buybill->id;
       $tot_item[$i]=$request->Quantity*$request->product_payment;
       $total_sum += $tot_item[$i];
       $buybillproduct->save();}

       $buybill->total_payment=$total_sum;
       $buybill->save();

    return back();

    }
    public function search(Request $request)
    {
      $start_at = $request ->start_at;
      $end_at = $request ->end_at;

      { $buyordr = BuyOrder::select('*')->where('type',1)->whereNull('deleted_at')->get();
        $i=0;
        $buy=BuyBill::select('*')->whereBetween('recieve_date',[$start_at,$end_at])->where('buy_order_id',$buyordr[0]->id)->get();
        foreach ($buyordr as $one) {
         $a= BuyBill::select('*')->whereBetween('recieve_date',[$start_at,$end_at])->where('buy_order_id',$one->id)->get();
         $buy->union($a);
         $i++;
        }
        $buybill=$buy->get();
     //return $end_at;
       return view('dashboard.received_warehouse_order_list',compact('buybill'));


      }
}

 public function inventory_search(Request $request)
    {
      $start_at = $request ->start_at;
      $end_at = $request ->end_at;

      { $buyordr = BuyOrder::select('*')->where('type',2)->whereNull('deleted_at')->get();
        $i=0;
        $buy=BuyBill::select('*')->whereBetween('recieve_date',[$start_at,$end_at])->where('buy_order_id',$buyordr[0]->id);
        foreach ($buyordr as $one) {
         $a= BuyBill::select('*')->whereBetween('recieve_date',[$start_at,$end_at])->where('buy_order_id',$one->id);
         $buy->union($a);
         $i++;
        }
        $buybill=$buy->get();
     //return $end_at;
       return view('dashboard.received_inventory_order_list',compact('buybill'));


     }}


}
