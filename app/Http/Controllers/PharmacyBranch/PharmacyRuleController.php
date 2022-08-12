<?php

namespace App\Http\Controllers\PharmacyBranch;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\PharmacyBranch\PharmacyRule;
class PharmacyRuleController extends Controller
{
      public function add()
   {

    return view('dashboard.PharmacyRule.add');
   }

   public function store(Request $request)
   {
  
        $pharmacyrules =new PharmacyRule;
       
        $pharmacyrules->min_amount_inventory=$request->min_amount_inventory;
        $pharmacyrules->min_amount_pharmacy=$request->min_amount_pharmacy;
        $pharmacyrules->Longest_replay_time=$request->Longest_replay_time;
        $pharmacyrules->The_biggest_loan=$request->The_biggest_loan;

        $pharmacyrules->save();
        return redirect('/PharmacyRule/all');
   }

   public function all()
   {
    $pharmacyrules=PharmacyRule::all();
    return view('dashboard.PharmacyRule.all',compact('pharmacyrules'));
   } 


   public function delete($id)
   {
     $pharmacyrules=PharmacyRule::where('id',$id);
     $pharmacyrules->delete();
     return back();

   }


   public function edit($id)
   {
   
    $pharmacyrules=PharmacyRule::find($id);
    

    return view('dashboard.PharmacyRule.edit',compact('pharmacyrules'));
   }


      public function update($id,Request $request)
   {
          //return $id;
         // return $request->id;
        $pharmacyrules=PharmacyRule::find($id);
      
        $pharmacyrules->min_amount_inventory=$request->min_amount_inventory;
          $pharmacyrules->min_amount_pharmacy=$request->min_amount_pharmacy;
           $pharmacyrules->Longest_replay_time=$request->Longest_replay_time;
             $pharmacyrules->The_biggest_loan=$request->The_biggest_loan;
        $pharmacyrules->save();
        return back();
   }
}
