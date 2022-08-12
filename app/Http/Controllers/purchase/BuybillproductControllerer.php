<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BuyBillProduct;
use Carbon\Carbon;
use App\Models\payment;
use App\Models\BuyBill;
use DB;

class BuybillproductControllerer extends Controller
{
  public function showaddview()
  {
    return view('dashboard.buybill.add');
  }

    public function store(Request $request)
    {
      $buybillproduct =new BuyBillProduct;
      $buybillproduct->Quantity=$request->Quantity;
      $buybillproduct->price=$request->price;
      $buybillproduct->buy_bill_id=$request->buy_bill_id;
      $buybillproduct->buy_product_id=$request->buy_product_id;
      $buybillproduct->save();
      return back();
    }



    public function all($id)
    {  //$show_the_products=$request->show_the_products;
      // $value=$show_the_products;
       $buybillproduct = BuyBillProduct::select('*')->where('buy_bill_id',$id)->get();
       $title = 'All buyproduct';
       //return $buybillproduct;
       $ID=$id;
      // return
       return view('dashboard.return_received_products_to_warehouse',compact('buybillproduct','title','ID'));
    }

    public function return($id,Request $request)
    {
      $buybillproduct=BuyBillProduct::select('*')->where('buy_bill_id',$id)->get();

      $l=0;
      foreach($buybillproduct as $one)
      {
      if($request->number[$l] + $buybillproduct[$l]->reverse <= $buybillproduct[$l]->quantity_recived &&$request->number[$l]!=null)
      {$buybillproduct[$l]->reverse = $buybillproduct[$l]->reverse +$request->number[$l] ;

      $buybillproduct[$l]->save();

      $payment=new payment;
      $payment->payment_price=-1*$request->number[$l]*$buybillproduct[$l]->individual_price;
      $payment->payment_date=$request->date ;
      $payment->buy_bill_product_id=$buybillproduct[$l]->id;
      $payment->save();
      $buybill=BuyBill::find($buybillproduct[$l]->buy_bill_id);
      $buybill->total_price=($buybill->total_price - (-1*$payment->payment_price));
      $buybill->save();
    }
    $l++;
    }
     //return $buybillproduct[$l]->reverse;

        return back();
    }


    public function edit($id)
    {   $buybillproduct =BuyBillProduct::find($id);
        return view('dashboard.buybillproduct.edit',compact('buybillproduct'));
    }

    public function update($id,Request $request)
    {$buybillproduct =BuyBillProduct::find($id);
      $buybillproduct->Quantity=$request->Quantity;
      $buybillproduct->price=$request->price;
      $buybillproduct->buy_bill_id=$request->buy_bill_id;
      $buybillproduct->buy_product_id=$request->buy_product_id;
      $buybillproduct->save();
      return back();
    }
  public function reverse()
  {  $buybillproduct = DB::table('buy_bill_products')
        ->where('reverse' ,'>',0)
        ->get();

        return view('dashboard.return_manufacturer_list',compact('buybillproduct')); }
}
