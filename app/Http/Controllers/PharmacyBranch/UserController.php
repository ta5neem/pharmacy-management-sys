<?php

namespace App\Http\Controllers\PharmacyBranch;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\PharmacyBranch\User;
use App\PharmacyBranch\Branch;
use Carbon\PharmacyBranch\Carbon;
use App\PharmacyBranch\Role;
use App\PharmacyBranch\Permission;

class UserController extends Controller
{

   public function all()
   {
    $users=User::all();
    return view('PharmacyBranch.User.user_list',compact('users'));
   } 

   public function delete($id)
   {

     $user=User::where('id',$id);
     $user->delete();
     return back();

   }


 public function edit($id)
   {
   $user=User::find($id);
    $permissions=Permission::all();
    $roles=Role::all();
    return view('PharmacyBranch.User.edit_user',compact('user','permissions','roles'));
   }
public function update(Request $request,$id)
{
$user=User::find($id);
$user->detachRoles($user->getRoles());
$user->detachPermissions($user->allPermissions());

      $user->salary=$request->salary;
      $user->working_hours=$request->working_hours;
      if($request->has('role')) 
     {
       $user->attachRole($request->role);
   //  $user->name_role=$request->role;
   }else
   {
      //   $user->name_role="undefine";

   }

      if($request->has('permissions')) 
      $user->attachPermissions($request->permissions);

      $user->save();
      // return $user->allPermissions();
   


      if($user->hasRole('employeeInventory'))
      {

        $branches=Branch::where('type',0)->get();

      }else if($user->hasRole('employeePharmacy'))
       {
        $branches=Branch::where('type',1)->get();

      }else {
        $branches=Branch::all();

      }




    return view('PharmacyBranch.User.select_Branch',compact('user','branches'));

}
public function selectBranch($id,Request $request)
{
   
       $user=User::find($id);
      $user->branch_id=$request->branch;
      $user->save();
     return redirect('/User/all');



}





        public function info_user()
        {
        return view('PharmacyBranch.User.my_profile');
        }

        public function edit_user()
        { 

        return view('PharmacyBranch.User.edit_profile');


        }
         public function update_user(Request $request)
        {

          	if(auth()->guard('web')->user()->id>0)
          	{
          $user=User::find(auth()->guard('web')->user()->id);
          $user->name=$request->name;
          $user->email=$request->email;
          $user->mobile=$request->mobile;

          $user->save();    
        return back();
        }



}



}