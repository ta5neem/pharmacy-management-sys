<?php
namespace App\Http\Controllers\PharmacyBranch;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\PharmacyBranch\Customer;
use App\PharmacyBranch\Cart;
use App\PharmacyBranch\Branch;
use App\PharmacyBranch\Invoice;
use App\PharmacyBranch\User;
use App\PharmacyBranch\Reckon;
use Carbon\Carbon;
class CustomerController extends Controller
{
      public function add()
      {
        
    return view('PharmacyBranch.Customer.add_customer');
      }

   public function store(Request $request)
   {


        $customer =new Customer;
        $customer->mobile=$request->phone;
        $customer->name=$request->name;
        $customer->reckoning=0;
         $customer->active=$request->radio;

        $customer->save();
        return back();
   }
   

    public function all_reckons($id)
   {
    $customer=Customer::find($id);
  
    return view('PharmacyBranch.Customer.all_debt_invoices_customer',compact('customer'));
   } 


   public function all()
   {
        $customers=Customer::all();
         $branches=Branch::all();
    return view('PharmacyBranch.Customer.customer_list',compact('customers','branches'));
   
   } 


   public function delete($id)
   {
     $customers=Customer::where('id',$id);
     $customers->delete();
     return back();
   }

 public function delete_loan($id)
   {
     $loan=Reckon::find($id);
     $loan->delete();
     return back();
   }

   public function edit($id)
   {
    $customer=Customer::find($id);
 

//      foreach ($customers->return_invoices()->get() as $value) {
//       //c u 
//   //  return $customers->return_invoices()->get();
// //return $value->invoiceReturn_invoiceProduct()->get()->first();

//         foreach ($value->invoiceReturn_invoiceProduct()->get() as $value1) {
//           //number
//        //   return $value1;
 

// foreach ($value1->invoice_product()->get() as  $value2) {

//   return $value2->product['name'];
// }
    
// }

     
//     }

     return view('PharmacyBranch.Customer.edit_customer',compact('customer'));

    // return view('dashboard.Customer.edit',compact('customers'));
   }
 public function report_customer(Request $request)
  {

      if($request->has('start_date')&& $request->has('end_date')) {
      $start_date = Carbon::parse($request->start_date)->toDateTimeString();                         
      $end_date = Carbon::parse($request->end_date)->toDateTimeString();

      $customers= Customer::whereBetween('created_at',[$start_date,$end_date])->get();

      }else if($request->has('name'))
      {
      $customers=Customer::where('name','LIKE',"%$request->name%")->orWhere('mobile','LIKE',"%$request->name%")->get();
      }

      else {
      $customers=Customer::all();
      }

         $branches=Branch::all();

    return view('dashboard.Customer.all',compact('customers','branches'));
    }


      public function update($id,Request $request)
   {    
        $customers=Customer::find($id);
        $customers->mobile=$request->phone;
        $customers->name=$request->name;
        $customers->active=$request->radio;
        $customers->save();

       return redirect('/Customer/all');
   }

   // public function search(Request $request)
   // {
   // 	  $customers=Customer::where('name','LIKE',"%$request->name%")->orWhere('mobile','LIKE',"%$request->name%")->get();

   // 	   return view('dashboard.Customer.all',compact('customers'));
   // }


public function paid_reckon($id , Request $request)
{
 
return $id;
 $customer=Customer::find($id);
    if ($customer) {
         $customer->reckoning= $customer->reckoning-$request->paid; 
          Reckon::create([
                'customer_id'=>$customer->id,
                'paid'=>$request->paid,
                'user_id'=>auth()->guard('web')->user()->id,
            'b'=>1

          ]);


         $customer->save();  
            return redirect('/Customer/all')->with([
                'message' =>'paid_successfully',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect('/Customer/all')->with([
                'message' =>'paid_failed',
                'alert-type' => 'danger'
            ]);
        }


}

// public function Invoice($id)
// {

//    $customer=Customer::find($id);
//     if (session()->has('cart')) {
//             $cart = new Cart(session()->get('cart'));
//         } else {
//             $cart = null;
//         }

//    return view('dashboard.Customer.buy',compact('customer','cart'));
// }






public function all_return_invoice($id)
{
     $customers=Customer::find($id);
      
     // $return_invoices=User::join('return_invoices','return_invoices.user_id','users.id');
      
   return view('dashboard.Customer.all_return_Invoice',compact('customers'));
}


public function all_product($id)
{
 $products=Invoice::join('invoice__products','invoice__products.invoice_id','=','invoices.id')->where('invoices.customer_id',$id)
->select('invoice__products.invoice_id','invoices.created_at','invoice__products.id','invoice__products.product_name','invoice__products.product_num','invoice__products.product_price','invoice__products.product_return')
->orderBy('invoice__products.product_name')
->orderBy('invoices.created_at')
  ->get();

  // return $products;
    return view('PharmacyBranch.Customer.customer_purchase_list',compact('products'));

}

public function all_invoice_Branch($C_id,$B_id)
{
    
  $invoices=User::join('invoices','invoices.user_id','users.id')
     ->where('invoices.customer_id','=',$C_id)
      ->where('invoices.branch_id',$B_id)
      ->whereNull('invoices.deleted_at')
  ->select('invoices.id','invoices.updated_at','invoices.total_due','users.name','invoices.paid')
     ->get();

       $branch=Branch::find($B_id);
          $branch=$branch->name;
          $customer=Customer::find($C_id);
          $customer=$customer->name;

  return view('PharmacyBranch.Customer.invoice_list_customer',compact('customer','invoices','branch'));
}

public function all_invoice_F($id)
{

//invoice_list_customer
          $branch=Branch::find(auth()->guard('web')->user()->branch_id);
          $branch=$branch->name;
          $customer=Customer::find($id);
          $customer=$customer->name;
          $invoices=User::join('invoices','invoices.user_id','users.id')
          ->where('invoices.customer_id','=',$id)
          ->whereNull('invoices.deleted_at')
          ->where('invoices.branch_id',auth()->guard('web')->user()->branch_id)
          ->select('invoices.id','invoices.updated_at','invoices.total_due','users.name','invoices.paid')
          ->get();

  return view('PharmacyBranch.Customer.invoice_list_customer',compact('customer','invoices','branch'));
}

public function all_invoice($id)
{
  
          $branch="All Branch";
          $customer=Customer::find($id);
          $customer=$customer->name;     $invoices=Customer::join('invoices','invoices.customer_id','customers.id')
     ->join('users','users.id','invoices.user_id')
      ->whereNull('invoices.deleted_at')
     ->where('customers.id','=',$id)
     ->select('invoices.id','invoices.updated_at','invoices.total_due','users.name','invoices.paid')
     ->get();

  return view('PharmacyBranch.Customer.invoice_list_customer',compact('customer','invoices','branch'));
}


public function all_Rinvoice_Branch($C_id,$B_id)
{
       


            $branch=Branch::find($B_id);
            $branch=$branch->mame;
            $customer=Customer::find($C_id);
                        $customer=$customer->mame;

            $invoices=User::join('return_invoices','return_invoices.user_id','users.id')
            ->where('return_invoices.customer_id','=',$C_id)
            ->where('invoices.branch_id',$B_id)
                  ->whereNull('return_invoices.deleted_at')

            ->select('return_invoices.id','return_invoices.updated_at','users.name')
            ->get();
  return view('PharmacyBranch.Customer.return_invoice_list_customer',compact('customer','invoices','branch'));
 

}
public function all_Rinvoice_F($id)
{
          $branch=Branch::find(auth()->guard('web')->user()->branch_id)->get('name');
          $customer=Customer::find($id)->get('name');
          $invoices=User::join('return_invoices','return_invoices.user_id','users.id')
          ->where('return_invoices.customer_id','=',$id)
          ->where('return_invoices.branch_id','=',auth()->guard('web')->user()->branch_id)
                ->whereNull('return_invoices.deleted_at')

          ->select('return_invoices.id','return_invoices.created_at','users.name','return_invoices.total_due','return_invoices.total_num')
          ->get();





    //$invoices1 = Invoice::where('created_at', '>',Carbon::now()->subDays(3));
   //return $customer->invoices[0]->id;
  return view('PharmacyBranch.Customer.return_invoice_list_customer',compact('customer','invoices','branch'));
}
public function all_Rinvoice($id)
{


     $customer=Customer::find($id)->get('name');
     $branch=Branch::find(auth()->guard('web')->user()->branch_id)->get('name');
      $invoices=User::join('return_invoices','return_invoices.user_id','users.id')
     ->where('return_invoices.customer_id','=',$id)
           ->whereNull('return_invoices.deleted_at')

     ->select('return_invoices.id','return_invoices.updated_at','users.name')
     ->get();
  return view('PharmacyBranch.Customer.return_invoice_list_customer',compact('customer','invoices','branch'));

}
}










