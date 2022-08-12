<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use PDF;
use DB;
use Carbon\Carbon;

class WarehouseControllerer extends Controller
{
  public function showaddview()
  {
    return view('dashboard.add_warehouse');
  }

    public function store(Request $request)
    {
      $manufacturer =new Warehouse;
      $manufacturer->name=$request->name;
      $manufacturer->address=$request->adress;
      $manufacturer->mobile=$request->mobile;
      $manufacturer->email=$request->email;
      $radio=$request->radio;
      if($request->radio=='Active')
      {$manufacturer->is_active=0;}
      elseif($request->radio=='Inactive' ){
        $manufacturer->is_active=1;
      }
      $manufacturer->save();
      return back();
    }

    public function all()
    { // $manufactorers = Warehouse::all();
      $manufactorers = Warehouse::select('*')->whereNull('deleted_at')->get();
      $title = 'All Manufactorers';
      $title2 = ' ';
      $date='';
      return view('dashboard.warehouse_list',compact('manufactorers'));
    }

    public function delete($id)
    {
      $manufactorers=Warehouse::where('id',$id)->first();
      //$inventory=Inventory::find($id);
      $manufactorers->delete();
      return back();
    }
      public function soft_delete($id)
      {
        $manufactorers=Warehouse::where('id',$id)->first();

        ///return $manufactorers;
        $manufactorers->deleted_at=Carbon::now()->format('Y-m-d');;
        $manufactorers->save();

        return back();
      }


    public function edit($id)
    {   $manufactorers =Warehouse::find($id);
      //return $manufactorers->adress;
        return view('dashboard.Edit_warehouse',compact('manufactorers'));
    }
    public function update($id,Request $request)
    { $manufacturers =Warehouse::find($id);
      if($request->radio=='Active')
      {//$manufacturer=null;
        $manufacturers->is_active=0;}
      else {
        //$manufacturer=null;
        $manufacturers->is_active=1;
      }
      $manufacturers->name=$request->name;
      $manufacturers->address=$request->adress;
      $manufacturers->mobile=$request->mobile;
      $manufacturers->email=$request->email;
      $radio=$request->radio;

      $manufacturers->save();
      //return $manufacturers;
      $manufactorers = Warehouse::all();
        //$manufactorers = Warehouse::select('*')->where('deleted_at','=','null');
        return view('dashboard.warehouse_list',compact('manufactorers'));
      }

    public function get_wareh()
    {
        $manufactorers = Warehouse::select('*')->get();
        return $manufactorers;
    }

    public function search(Request $request)
    {    $title = 'Manufactorers';
         $title2 = ' ';
          $date='';
        $manufactorers = Warehouse::select('*')->where('name','LIKE',"%$request->search%")
        ->orWhere('id','LIKE',"%$request->search%")->orWhere('adress','LIKE',"%$request->search%")
        ->orWhere('mobile','LIKE',"%$request->search%")->orWhere('email','LIKE',"%$request->search%")->get();
        return view('dashboard.manufacturer.all',compact('manufactorers','title','title2','date'));

    }

      public function downloadPdf($title,$title2)
    {
         $pdf=\App::make('dompdf.wrapper');
         $pdf->loadHTML($this->convert_warehouses_to_html($title,$title2));
         return $pdf->stream();

    }




    public function convert_warehouses_to_html($title,$title2)
    {  $manufactorers=$this->get_wareh();
      $output = '
     <h3 align="center">werehouse  Data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
     <th style="border: 1px solid; padding:12px;" width="20%">id</th>
     <th style="border: 1px solid; padding:12px;" width="30%">name</th>
     <th style="border: 1px solid; padding:12px;" width="15%">adress</th>
     <th style="border: 1px solid; padding:12px;" width="15%">mobile</th>
     <th style="border: 1px solid; padding:12px;" width="20%">email</th>
    </tr>
     ';
     foreach($manufactorers as $manufactorer)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$manufactorer->id.'</td>
       <td style="border: 1px solid; padding:12px;">'.$manufactorer->name .'</td>
       <td style="border: 1px solid; padding:12px;">'.$manufactorer->adress.'</td>
       <td style="border: 1px solid; padding:12px;">'.$manufactorer->mobile.'</td>
       <td style="border: 1px solid; padding:12px;">'.$manufactorer->email.'</td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;

    }

}
