<?php
namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyOrder;
use App\Models\BuyProduct;
use App\Models\BuyBillProduct;
use App\Models\BuyBill;
use App\Models\MedicaSupply;
use App\Models\medicine;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DateTime;
use App\Http\Controllers\Date;
use App\Models\Product;
use App\payment;



class OptionsController extends Controller
{

public function remove()
  {
    return view('dashboard.options.remove');
  }
public function do_the_remove(Request $request)
{
  if($request->type =='full_remove')
    { $buyordr=BuyOrder::select('*')->where('id',$request->id)->get();
      $buybill=BuyBill::select('*')->where('buy_order_id',$request->id)->value('id');
      $billproduct=BuyBillProduct::select('*')->where('buy_bill_id',$buybill)->get();
      foreach ($billproduct as $key) {
      $key ->Quantity =0;
      }
       $title=$request->type;

     return view('dashboard.options.full_remove',compact('buyordr','title'));}

     if($request->type =='partial_remove')
     {$buyordr=BuyOrder::select('*')->where('id',$request->id)->get();
      $buybill=BuyBill::select('*')->where('buy_order_id',$request->id)->value('id');
      $pr_id=$request->product_id;
      $billproduct=BuyBillProduct::select('*')->where([['buy_bill_id','=',$buybill],['buy_product_id','=', $pr_id]])->get();
      //$billproduct=$billproduc->where('buy_product_id',$pr_id)->get();
    /*  foreach ($billproduct as $key ) {
        $key->Quantity =($key->Quantity) - ($request->Quntity);
      }*/
      return $billproduct;
    }
}

public function display_order_reports()
{
   $paid_of_order=BuyBill::select('*')->sum('total_payment');
  $num_order=Buyorder::select('*')->count('id');
  $value_of_order=BuyBill::select('*')->sum('total_price');
  $num_of_product=Product::select('*')->count('id');
  $buyordr=BuyOrder::select('*')->get();


   return view('dashboard.warehouse_orders_report',compact('paid_of_order','num_order','value_of_order','num_of_product','buyordr'));

}
public function display_warehouse_reports()
  {
     $num_ware=warehouse::select('*')->count('id');
             $order_num=BuyOrder::select('*')->where('type',1)->count('id');
             $warehouse=warehouse::select('*')->get();
            //return  $order_num;
            return view('dashboard.warehouse_report',compact( 'num_ware' ,'order_num','warehouse',));
  }


  public function active_ware()
  {
    $num_ware=warehouse::select('*')->count('id');
    $order_num=BuyOrder::select('*')->where('type',1)->count('id');


    $manufactorers = Warehouse::join("buy_orders", "buy_orders.warehouse_id", "=", "warehouses.id")
      ->groupBy("buy_orders.warehouse_id")
      ->orderBy(DB::raw('COUNT(warehouses.id)'), 'asc')
      ->take(1)
      ->get(array(DB::raw('warehouses.*')));
      return $warehouse;
       return view('dashboard.warehouse_report',compact( 'num_ware' ,'order_num','warehouse',));


  }


  public function inactive_ware()
  {
    $num_ware=warehouse::select('*')->count('id');
    $order_num=BuyOrder::select('*')->where('type',1)->count('id');
    $manufactorers = Warehouse::join("buy_orders", "buy_orders.warehouse_id", "=", "warehouses.id")
    ->select('warehouses.*')
      ->groupBy("buy_orders.warehouse_id")
      ->orderBy(DB::raw('COUNT(warehouses.name)'), 'desc')
      ->take(1)
      ->get(array(DB::raw('warehouses.*')));
    return view('dashboard.warehouse_report',compact( 'num_ware' ,'order_num','warehouse'));}





     public function search(Request $request )
    { $medicine=Midicin::select('*')->where('generic_name',$request->search)->orWhere('id',$request->search)->orWhere('alternative_medicines',$request->search)->get();
      return view('dashboard.buyorder.add',compact( 'medicine' ));

    }

    public function Totalbill()
    {
    $num_of_order=BuyOrder::select('*')->count('id');//Number

    $num_of_rcieve_order=BuyBill::select('*')->count('id');//Number

    $total_price=BuyBillProduct::select('*')->sum('individual_price');
    $payment_price=BuyBillProduct::select('*')->sum('payment_price');
    $buybill = DB::table('buy_bills')//Ricieve
    ->whereColumn('total_price', 'total_payment')
    ->count('id');

    $profits=$payment_price-$total_price;//Profits

    return $buybill;

    }

public function financial()
{
 $financial=payment::all();
 return view('dashboard.reports&invoices.financial',compact( 'financial' ));
}

public function reports(Request $request)
{
if( $request->type && $request->start_at =='' && $request->end_at =='')
 {
   $date = date($request->date);
   $mo=\Carbon\Carbon::parse($request->date)->format('m');
   $da=\Carbon\Carbon::parse($request->date)->format('d');
   $ye=\Carbon\Carbon::parse($request->date)->format('Y');

   if($request->type == 'Daily_Reports')
      { if($request->type2== 'Paid_Order')
   {
    $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
        ->whereMonth('recieve_date', $mo)->whereDay('recieve_date', $da)
          ->whereColumn('recieve_date', 'total_payment')
        ->get();
      $title=$request->type;
       $title2= $request->type2;
      return view('dashboard.reports&invoices.reports',compact('buybill','title','title2','date'));}

     else if($request->type2== 'Non_Paid_Order')
    {
      $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
          ->whereMonth('recieve_date', $mo)->whereDay('recieve_date', $da)
          ->whereColumn('total_price','>' ,'total_payment')
          ->get();

        $title=$request->type;
         $title2= $request->type2;
        return view('dashboard.reports&invoices.reports',compact('buybill','title','title2','date'));}

        else if($request->type2== 'removed_invoice')
        {/*->whereYear('expaire_date', $ye)
            ->whereMonth('expaire_date', $mo)->whereDay('expaire_date', $da)*/
          $buybillproduct = DB::table('buy_bill_products')
              ->where('reverse','>' ,0)
              ->get();
              $title=$request->type;
              $title2= $request->type2;
              return view('dashboard.options.full_remove',compact('buybillproduct','title','title2','date'));  }

    }
    else if($request->type == 'Monthly_Reports')
    {
      if($request->type2== 'Paid_Order')
   {

    $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
        ->whereMonth('recieve_date', $mo)
          ->whereColumn('total_price', 'total_payment')
        ->get();
      $title=$request->type;
       $title2= $request->type2;
      return view('dashboard.reports&invoices.reports',compact('buybill','title','title2','date'));}

     else if($request->type2== 'Non_Paid_Order')
    {
      $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
          ->whereMonth('recieve_date', $mo)
          ->whereColumn('total_price','>' ,'total_payment')
          ->get();

        $title=$request->type;
         $title2= $request->type2;
        return view('dashboard.reports&invoices.reports',compact('buybill','title','title2','date'));}

        else if($request->type2== 'removed_invoice')
        {
          $buybillproduct = DB::table('buy_bill_products')
              ->where('reverse','>' ,0)
              ->get();
               $title=$request->type;
               $title2= $request->type2;
              return view('dashboard.options.full_remove',compact('buybillproduct','title','title2','date'));  }


    }
    else if($request->type == 'Annuual_Reports')
    {
      if($request->type2== 'Paid_Order')
   {
        $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
        ->whereColumn('total_price', 'total_payment')
        ->get();
      $title=$request->type ;
       $title2= $request->type2;
      return view('dashboard.reports&invoices.reports',compact('buybill','title','title2','date'));}

     else if($request->type2== 'Non_Paid_Order')
    {
      $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
          ->whereColumn('total_price','>' ,'total_payment')
          ->get();
         $title=$request->type;
         $title2= $request->type2;
        return view('dashboard.reports&invoices.reports',compact('buybill','title','title2','date'));}

      else if($request->type2== 'removed_invoice')
        {
          $buybillproduct = DB::table('buy_bill_products')
              ->where('reverse' ,'>',0)
              ->get();
               $title=$request->type;
               $title2= $request->type2;
              return view('dashboard.options.full_remove',compact('buybillproduct','title','title2','date'));  }
    }

        if($request->type2== 'efectiveness')
      {$manufactorers = Warehouse::join("buy_orders", "buy_orders.warehouse_id", "=", "warehouses.id")
        ->groupBy("buy_orders.warehouse_id")
        ->orderBy(DB::raw('COUNT(warehouses.id)'), 'desc')
        ->take(1)
        ->get(array(DB::raw('warehouses.*')));
        $title = 'All Warehouse';
        $title2 = '';
        $date='';
        return view('dashboard.manufacturer.warehousereport',compact('manufactorers','title','title2','date'));
      }


      else if($request->type2== 'non_efectiveness')
      {
        $manufactorers = Warehouse::join("buy_orders", "buy_orders.warehouse_id", "=", "warehouses.id")
          ->groupBy("buy_orders.warehouse_id")
          ->orderBy(DB::raw('COUNT(warehouses.id)'), 'asc')
          ->take(1)
          ->get(array(DB::raw('warehouses.*')));
          $title = 'All Warehouse';
          $title2 = '';
          $date='';
          return view('dashboard.manufacturer.warehousereport',compact('manufactorers','title','title2','date'));

      }

      else if($request->type2== 'Non_recieved_Order')
      {
        $buyOrder = BuyOrder::join("buy_products", "buy_products.buy_order_id", "=", "buy_orders.id")
        ->join('buy_bill_products','buy_bill_products.buy_product_id', "=",'buy_products.id')
         ->where('buy_bill_products.quantity_recived','buy_products.quantity_order')
          ->get();
          $title = 'order';
          $title2 = '';
          $date='';
          return view('dashboard.buyorder.orderReposts',compact('buyOrder','title','title2','date'));

      }
  }


}




}
