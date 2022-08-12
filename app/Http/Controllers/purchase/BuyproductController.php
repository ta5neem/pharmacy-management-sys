<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyProduct;
use Carbon\Carbon;

class BuyproductController extends Controller
{
  public function showaddview()
  {
    return view('dashboard.buyproduct.add');
  }

    public function store(Request $request)
    {
      $buyproduct =new BuyProduct;
      $buyproduct->Quantity=$request->Quantity;
      $buyproduct->Buy_order_id=$request->Buy_order_id;
      $buyproduct->product_id=$request->product_id;
      $buyproduct->save();
      return back();
    }



    public function all($id)
    {
       $buyproduct = BuyProduct::select('*')->where('buy_order_id',$id)->whereNull('deleted_at')->get();
       $title = 'All buyproduct';
       return view('dashboard.display_ordered_products',compact('buyproduct','title','id'));
    }

    public function delete($id)
    {
      $buyproduct=BuyProduct::where('id',$id)->first();
      $buyproduct->delete();
      return back();

    }

    public function edit($id)
    {   $buyproduct =BuyProduct::find($id);
        return view('dashboard.buyproduct.edit',compact('buyproduct'));
    }

    public function update($id,Request $request)
    {$buyproduct =BuyProduct::find($id);
      $buyproduct->Quantity=$request->Quantity;
      $buyproduct->Buy_order_id=$request->Buy_order_id;
      $buyproduct->product_id=$request->product_id;
      $buyproduct->save();
      return back();
    }
}
