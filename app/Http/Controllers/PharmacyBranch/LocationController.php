<?php

namespace App\Http\Controllers\PharmacyBranch;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\PharmacyBranch\Location;
class LocationController extends Controller
{
     public function add()
   {
     $locations=Location::all();

    return view('dashboard.Location.add',compact('locations'));
   }

   public function store(Request $request)
   {
  
        $location =new Location;
        $location->name=$request->name;
        $location->parent_id=$request->parent_id;
        $location->save();
        return redirect('/locations/all');
   }

   public function all()
   {
    $locations=Location::all();
    return view('dashboard.Location.all',compact('locations'));
   } 


   public function delete($id)
   {
     $locations=Location::where('id',$id);
     $locations->delete();
     return back();

   }


   public function edit($id)
   {
    $location=Location::find($id);
    $locations=Location::all();
   
    return view('dashboard.Location.edit',compact('locations','location'));
   }


      public function update($id,Request $request)
   {
          //return $id;
         // return $request->id;
        $locations=Location::find($id);
        $locations->name=$request->name;
        $locations->parent_id=$request->parent_id;
        $locations->save();
        return back();
   }
}

