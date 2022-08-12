<?php
namespace App\Http\Controllers\PharmacyBranch;
use App\Http\Controllers\Controller;

use App\PharmacyBranch\Cart;
use App\PharmacyBranch\reckoning ;
use App\PharmacyBranch\Product;
use App\PharmacyBranch\Cart_return;
use App\PharmacyBranch\Invoice;
use App\PharmacyBranch\Customer;
use App\PharmacyBranch\Invoice_Products;
use App\PharmacyBranch\PharmacyRule;
use App\PharmacyBranch\ReturnInvoice;
use App\PharmacyBranch\Role;
use App\PharmacyBranch\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\PharmacyBranch\IrIp;
use Carbon\Carbon;
use App\PharmacyBranch\Reckon;
use App\PharmacyBranch\Branch;
use App\Models\BookIn;
use Illuminate\Support\Facades\DB;
class Invoice2Controller extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }


public function test()
{


   $bestProducts= Invoice_Products::groupBy('product_name')
   ->selectRaw(' sum(product_num) as sum ,product_name  ')->take(10)->orderBy('sum','DESC')->get();



//[{"sum":"15","product_name":"P2"},{"sum":"13","product_name":"P1"},{"sum":"2","product_name":"Gail Bernier"}]


$months = Invoice::select(
DB::raw('DATE_FORMAT(created_at, "%M") as month
 , sum(total_due) as total,sum(total_num) as totalPaid ,sum(id) as totalCount '))
->groupBy('month')
->get();


$invoices=Invoice::all();
// foreach ($months as  $value) {
//   echo var_dump($value->total);
// }
$AdminUsers = User::whereHas(
    'roles', function($q){
        $q->where('name', 'admin');
    }
)->get();

  return view('index',compact('months','invoices','bestProducts','AdminUsers'));

}


    public function index()
    {
     $customers=Customer::all();
    return view('PharmacyBranch.Invoice.add_invoice2',compact('customers'));
    }

    
  public function print_invoice($id)
    {     
    $invoice = Invoice::find($id);
    return view('PharmacyBranch.Invoice.print_invoice',compact('invoice'));
    }


   public function store(Request $request)
   {
    $invoice=Invoice::create(array(
        'user_id'=>auth()->guard('web')->user()->id,
        'branch_id'=>auth()->guard('web')->user()->branch_id,
        'customer_id'=>$request->customer,
        'total_due'=>$request->total_amount,
        'paid'=>$request->paid_amount,
        'total_num'=>array_sum($request->quantity),
        'discount_value'=>$request->invoice_discount,
    )
    );
 for($i=0 ; $i<count($request->product_name);$i++)
{

    
    Invoice_Products::create([
                      'invoice_id'=>$invoice->id,
                      'bookIn_id'=>$request->id_product[$i],
                      'product_num'=>$request->quantity[$i],
                      'product_price'=>$request->price[$i],
                      'product_name'=>$request->product_name[$i],
                      'discount_value'=>$request->discount[$i],
                       ]); 
    BookIn::find($request->id_product[$i])->decrement('amount', $request->quantity[$i]);

}


    if($request->radio=="on")
    {
              return view('PharmacyBranch.Invoice.stripe',['amount' =>$request->paid_amount ]);
    }else
    {
    return back();
    }

   }
    public function show($id)
    {

       $invoice = Invoice::find($id);
    return view('PharmacyBranch.Invoice.display_invoice', compact('invoice'));
      

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

public function delete_Invoice($id)
{

 $invoice = Invoice::find($id);
 
 $invoice->delete();
 return back();


}

public function delete_loan($id)
{

 $Reckon= Reckon::find($id);
 $Reckon->delete();
 return back();

}

public function delete_returnInvoice($id)
{
$invoice = ReturnInvoice::find($id);
$invoice->delete();
return back();

}



public function ReturnInvoice()
{
     if (session()->has('cart_return')) {
         
           $cart = new Cart_return(session()->get('cart_return'));
              $RI=ReturnInvoice::create(array(
                   'customer_id'=>$cart->customer,
                     'user_id'=>auth()->guard('web')->user()->id,
                    'branch_id'=>auth()->guard('web')->user()->id,
                    'total_due'=>$cart->totalPrice,
 'total_num'=>$cart->totalQty,

                       )); 

             if(is_array($cart) || is_object($cart))
          {
            foreach ($cart as  $value) { 
               if(is_array($value) || is_object($value))
                {
                    foreach ($value as $value1) {
                     //ReturnInvoice_Invoice_product
                       IrIp::create(array(
                      'ip_id'=>$value1['I_P']->id,
                      'ri_id'=>$RI->id,
                      'num_pr'=>$value1['qty'],
                    
                       )); 
                       return $value1['I_P'];

                       
    // BookIn::find($request->id_product[$i])->decrement('amount', $request->quantity[$i]);


                       $I_P=Invoice_Products::where('invoice_id','=',$value1['I_P']->invoice_id)->where('bookIn_id','LIKE',$value1['I_P']->bookIn_id)->first();
                       if($I_P)
                       {

                        $I_P->product_return+=$value1['qty'];
                        $I_P->save();
                      }
                       
                       }
                 }
              }
                session()->forget('cart_return');

          return redirect()->back()->with([
          'message' =>'buy successfully',
          'alert-type' => 'success'
          ]);
          }
        } }
 
public function returnI($I_P,Request $request)
{

$I_P=Invoice_Products::find($I_P);
$Invoice=Invoice::find($I_P->invoice['id']);

   if (session()->has('cart_return')) {

           $cart = new Cart_return(session()->get('cart_return'));


              if($Invoice)
              {
                if(! ( $Invoice->customer['id'] == $cart->customer ))
                {
  return redirect()->back()->with([
               'message' =>'this cart to another customer',
                'alert-type' => 'danger'
            ]);

                }

              }
        } else {

           $cart = new Cart_return();
              if($Invoice)
              {
               // return $Invoice->customer['id'];
                   $cart->addCustomer($Invoice->customer['id']); 
             
              }
              else
              {
                return "runn";
              }
          
        }

        $cart->add($I_P,$request->num_return);
      //return $request->num_return;
      
        session()->put('cart_return', $cart);
        // return dd(session()->get('cart_return'));
        return redirect()->back();

}




 public function returnInvoice_all(Request $request)
    {

        if($request->has('start_date')&& $request->has('end_date')) {
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();                         
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();

        $invoices= Invoice::whereBetween('created_at',[$start_date,$end_date])->get();

        } else {
        $invoices= Invoice::all();
        }

        return view('dashboard.Invoice.all_return_invoice',compact('invoices'));
    }


public function reckon_all()
{

  $reckons=Reckon::all();
  return view('PharmacyBranch.Invoice.all_debt_invoices',compact('reckons'));

}



public function return_invoice($id)
{
   $invoice=ReturnInvoice::find($id);

  return view('PharmacyBranch.Invoice.display_return_invoice',compact('invoice'));
   
}

//=======================================
public function all_invoice_forBranch($type_file,$id,Request $request)
{
 
      $branches=Branch::where('type',1);
      if($request->has('start_date')&& $request->has('end_date')) {
      $start_date = Carbon::parse($request->start_date)->toDateTimeString();                         
      $end_date = Carbon::parse($request->end_date)->toDateTimeString();
      $invoices= Invoice::whereBetween('created_at',[$start_date,$end_date])->where('branch_id',$id)->get();
      } else {
      $invoices= Invoice::where('branch_id',$id)->get();
    }

if($type_file=="report")
   return view('PharmacyBranch.Invoice.invoice_report_branch',compact('invoices'));
 else if($type_file=="list")
   return view('PharmacyBranch.Invoice.invoice_list_in_branch',compact('invoices'));

}

public function all_invoice($type_file,Request $request)
{
      $branches=Branch::where('type',1)->get();

      if($request->has('start_date')&& $request->has('end_date')) {
      $start_date = Carbon::parse($request->start_date)->toDateTimeString();                         
      $end_date = Carbon::parse($request->end_date)->toDateTimeString();

      $invoices= Invoice::whereBetween('created_at',[$start_date,$end_date])->get();

      } else {
      $invoices= Invoice::all();
      }

      if($type_file=="report")
      return view('PharmacyBranch.Invoice.invoice_report',compact('invoices','branches'));
      else if($type_file=="list")
      return view('PharmacyBranch.Invoice.invoice_list', compact('invoices','branches'));
    return 1;

}

public function annual_invoice()
{
      $branches=Branch::where('type',1)->get();
         $invoices= Invoice::whereYear('created_at', date('Y'))->get();

      return view('PharmacyBranch.Invoice.annual_invoice_report',compact('invoices','branches'));
     

}

public function all_delayed_invoice($type_file,Request $request)
{
      $branches=Branch::where('type',1)->get();

      if($request->has('start_date')&& $request->has('end_date')) {
      $start_date = Carbon::parse($request->start_date)->toDateTimeString();                         
      $end_date = Carbon::parse($request->end_date)->toDateTimeString();

      $invoices= Invoice::whereBetween('created_at',[$start_date,$end_date])->whereColumn('total_due', '>', 'paid')->get();

      } else {
      $invoices= Invoice::whereColumn('total_due', '>', 'paid')->get();
      }

      if($type_file=="report")
      return view('PharmacyBranch.Invoice.delayed_invoice_report',compact('invoices','branches'));
      else if($type_file=="list")
      return view('PharmacyBranch.Invoice.delayed_invoice_list', compact('invoices','branches'));
    return 1;

}

//----------------------
public function all_retuen_invoice($type_file,Request $request)
{
      $branches=Branch::where('type',1)->get();

      if($request->has('start_date')&& $request->has('end_date')) {
      $start_date = Carbon::parse($request->start_date)->toDateTimeString();                         
      $end_date = Carbon::parse($request->end_date)->toDateTimeString();

      $invoices= ReturnInvoice::whereBetween('created_at',[$start_date,$end_date])->get();

      } else {
      $invoices= ReturnInvoice::all();
      }

      if($type_file=="report")
      return view('PharmacyBranch.Invoice.return_invoice_report',compact('invoices','branches'));
      else if($type_file=="list")
      return view('PharmacyBranch.Invoice.return_invoice_list', compact('invoices','branches'));

}
public function all_return_invoice_forBranch($type_file,$id,Request $request)
{
 
      $branches=Branch::where('type',1);
      if($request->has('start_date')&& $request->has('end_date')) {
      $start_date = Carbon::parse($request->start_date)->toDateTimeString();                         
      $end_date = Carbon::parse($request->end_date)->toDateTimeString();
      $invoices= ReturnInvoice::whereBetween('created_at',[$start_date,$end_date])->where('branch_id',$id)->get();
      } else {
      $invoices= ReturnInvoice::where('branch_id',$id)->get();
    }
  

if($type_file=="report")
   return view('PharmacyBranch.Invoice.return_invoice_report_branch',compact('invoices'));
 else if($type_file=="list")
   return view('PharmacyBranch.Invoice.return_invoice_list_in_branch',compact('invoices'));

}

//===========================

public function all_returnInvoice_forBranch($id)
{
  
return Branch::find($id)->with('return_invoices');
  
}
  public function charge(Request $request)
    {

        $charge = Stripe::charges()->create([
        'currency' => 'USD',
        'source' => $request->stripeToken,
        'amount'   => $request->amount,
        'description' => ' Test from laravel new app'
        ]);

        $chargeId = $charge['id'];

        if ($chargeId) {
        return redirect()->route('store')->with('success', " Payment was done. Thanks");
        } else {
return redirect()->back();
        }
   }


     public function report_returnInvoice(Request $request)
{

if($request->has('start_date')&& $request->has('end_date')) {
$start_date = Carbon::parse($request->start_date)->toDateTimeString();                         
$end_date = Carbon::parse($request->end_date)->toDateTimeString();
$invoices= ReturnInvoice::whereBetween('created_at',[$start_date,$end_date])->get();


    } else {
$invoices= ReturnInvoice::all();
    }

  return view('PharmacyBranch.Invoice.return_invoice_list',compact('invoices'));

// $count_return_invoices =$return_invoices->count('id');
// $sum_total_return_invoices =$return_invoices->sum('total_due');
// $sum_product_return_invoices =$return_invoices->sum('total_num');
   //    if($x==1)
   //  {
   // return view('',compact('return_invoices'));

   //  }
   //  else
   //  {
   // return view('',compact('return_invoices'));

  //  }

}

     public function report_reckon($x,Request $request)
{


        if($request->has('start_date')&& $request->has('end_date')) {
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();                         
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();

        $reckons= Reckon::whereBetween('created_at',[$start_date,$end_date])->get();

        } else {
        $reckons= Reckon::all();
       }

        // $count_loans =$loans->count('id');
        // $sum_loans =$loans->sum('paid');

        return $x==1 ?view('',compact('reckons')) : view('',compact('reckons')) ;

        // if($x==1)
        // {
        // return view('',compact('reckons'));

        // }
        // else
        // {
        // return view('',compact('reckons'));

        // }


}

public function showCartReturn()
{  
    if (session()->has('cart_return')) {
            $cart = new Cart(session()->get('cart_return'));
        } else {
            $cart = null;
        }

       return view('PharmacyBranch.Invoice.add_return_invoice', compact('cart'));
}

       public function destroyR(Invoice_Products $IP)
    {


        $cart = new Cart_return(session()->get('cart_return'));
        $cart->remove($IP->id);

       if ($cart->totalQty <= 0) {
            session()->forget('cart_return');
        } else {
            session()->put('cart_return', $cart);
        }
        return redirect()->route('cartReturn.show')->with('success', 'Product was removed');
    }

}