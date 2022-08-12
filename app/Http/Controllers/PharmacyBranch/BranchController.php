<?php

namespace App\Http\Controllers\PharmacyBranch;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\PharmacyBranch\Branch;
use App\PharmacyBranch\Location;

class BranchController extends Controller
{
      public function add()
   {
$locations=Location::all();
    return view('PharmacyBranch.Branch.add_branch',compact('locations'));
   }

   public function store(Request $request)
   {
        $branch =new Branch;
        $branch->name=$request->name;
        $branch->email=$request->email;
        $branch->location_id=$request->Location;
        $branch->type=$request->type;
                $branch->active=$request->active;


        $branch->save();
        return redirect('/branchs/all');
   }

   public function all()
   {
    $branchs=Branch::all();
    return view('PharmacyBranch.Branch.branch_list',compact('branchs'));
   } 


   public function delete($id)
   {
     $branchs=Branch::where('id',$id);
     $branchs->delete();
     return back();

   }


   public function edit($id)
   {
    $branch=Branch::find($id);
   $locations=Location::all();

    return view('PharmacyBranch.Branch.branch_edit',compact('branch','locations'));
   }


      public function update($id,Request $request)
   {
          //return $id;
         // return $request;
    
        $branch=Branch::find($id);
       $branch->name=$request->name;
        $branch->email=$request->email;
        $branch->location_id=$request->Location;
        $branch->type=$request->type;
                $branch->active=$request->active;
        $branch->save();
        return redirect('/branchs/all');
   }





}

  // public function activity()
  //       {
  //           return $this->hasMany('App\Activity')
  //               ->with(['user', 'subject'])
  //               ->latest()->get();
  //       }