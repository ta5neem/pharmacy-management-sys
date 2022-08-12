<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgeGroupRequest;
use App\Models\AgeGroup;
use App\Models\BookIn;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AgeGroupController extends Controller
{
    public function create()
    {
        //view form to create the age group
        return view('product.ageGroup.addAgeGroup');
    }

    public function store(AgeGroupRequest  $request)
    {
        //save age group into database
        AgeGroup::create([
            'name_age_group'=> $request->name_age_group,
        ]);
        return redirect()->back();
    }

    public function getAll()
    {
        $user = auth()->user();

        $agegroups = BookIn::join('buy_bill_products', 'books_in.buy_bill_product_id', '=', 'buy_bill_products.id')
            ->join('buy_products', 'buy_bill_products.buy_product_id', '=', 'buy_products.id')
            ->join('products', 'buy_products.product_id', '=', 'products.id')
            ->join('medicines', 'products.id', '=', 'medicines.product_id')
            ->join('age_groups', 'medicines.age_group_id', '=', 'age_groups.id')
            ->where('books_in.branch_id', $user->branch_id)
            ->whereNull('age_groups.deleted_at')
            ->select('age_groups.id','name_age_group')->distinct()->get();

            return view('product.ageGroup.showAgeGroups', compact('agegroups'));
    }

    public function edit($id)
    {
        //search id age group.
        $ageGroup = AgeGroup::find($id);
        if(!$ageGroup)
            return redirect()->back() ;
        $ageGroup = AgeGroup::select('id', 'name_age_group')->find($id);
        return view('product.ageGroup.editAgeGroup', compact('ageGroup'));
    }

    public function update(AgeGroupRequest $request, $id)
    {
        //check if ageGroup exist.
        $ageGroup = AgeGroup::find($id);
        if(!$ageGroup)
            return redirect() -> back() ;
        //update data.
        $ageGroup -> update($request->all());
        return redirect()->back();
    }

    public function delete($id)
    {
        //check if id age group exist.
        $ageGroup = AgeGroup::find($id);
        if(!$ageGroup)
            return redirect()->back();

        //delete the age group.
        $ageGroup -> delete();
        return redirect()->back();
    }

}
